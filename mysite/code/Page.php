<?php
class Page extends SiteTree {

	private static $db = array(
		/*"Keywords" => "Text" */
	);

	private static $has_one = array(
	);
	
	private static $defaults = array( 
'ShowInMenus' => 0 
);
	
	//static $searchable_fields = array('Keywords', 'Content', 'Title');
	

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
		"queryTest",
		"SplitKeywords",
		"results",
		'show'
	);
	
	

	public function init() {
		parent::init();

	}
	/**
	* Create custom search results when a user searches
	*/
	
	function results($data, $form, $request)
	  {	
		
	  	
	    $keyword = trim($request->requestVar('Search'));
	    $keyword = Convert::raw2sql($keyword);
	     
	    $keywordArray = explode(" ", $keyword);
	 

	    $keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');    
	    	    
	    $pages = new ArrayList(); //Output these to template
	    $dataObjects = new ArrayList(); //Output these to template
	   
	    
	    $bibliographyFlag = false; //set to true below if checkbox in searchform.ss is checked
	    
	    //$searchedClasses = array('subtopics', 'people', 'essays', 'countries', 'audio pieces', 'video pieces', 'art photos', 'field photos'
	    //Define classes for outputting to template
	    $subtopics = new ArrayList();
	    $people = new ArrayList();
	    $essays = new ArrayList();
	    $countries = new ArrayList();
	    $audioPieces = new ArrayList();
	    $videoPieces = new ArrayList();
	    $photos = new ArrayList();
	    $photos = new ArrayList();
	    
	      $data = array(
	      'Subtopic' => $subtopics,
	      'People' => $people,
	      'Essay' => $essays,
		  'Country' => $countries,
		  'AudioPiece' => $audioPieces,
		  'VideoPiece' => $videoPieces,
		  'ArtPhoto' => $photos,
		  'FieldPhoto' => $photos,
		  'Query' => $keyword
			); 
	    
	    $siteTreeClasses = array('Chapter', 'Subtopic'); //add in an classes that extend Page or SiteTree
	    $dataObjectClasses = array('Country', 'Essay', 'People'); //add in your DataObjects
	    $bibliographyClasses = array('Essay', 'MediaPiece'); //add classes with the Bibliography field
	    
	    //When the bibliography check box is checked, only search classes that have the Bibliography field + Essays
	    if ($request->requestVar('Search_Bibliography')){
	  		$siteTreeClasses = array_intersect($bibliographyClasses, $siteTreeClasses);
	  		$dataObjectClasses = array_intersect($bibliographyClasses, $dataObjectClasses);

	  		$bibliographyFlag = true; //bibliography search
	  	}
	  	
	    $objects = array();
	     
	    foreach ( $siteTreeClasses as $c )
	    {
	      $siteTreeMatch = $this->getItemMatch($c, $request, $keywordArray, $keywordHTML, 'Title, MenuTitle, ', $bibliographyFlag); //This function is in Page.php
	      $query = DataList::create($c)
	       // ->filter(array('RootLanguageParentID' => $this->RootLanguageParentID))
	        ->where($siteTreeMatch);

	      $query = $query->dataQuery()->query();
	     	      
	      $query->addSelect(array('Relevance' => $siteTreeMatch));
	      
	    
	      $records = DB::query($query->sql());
	    
	    
		
	      //$objects = array();
	      foreach( $records as $record )
	      {
	      	
	        if ( in_array($record['ClassName'], $siteTreeClasses) )
	         $objects[] = new $record['ClassName']($record);
	      }
	      
	   
	      $pages->merge($objects);
	    }
	    
	    
	    /*
	     *  DataObjects
	     */

	     foreach ($dataObjectClasses as $c){
	        $dataObjectsItemMatch = $this->getItemMatch($c, $request, $keywordArray, $keywordHTML, '', $bibliographyFlag); //This function is in Page.php
	        
		    $query = DataList::create($c)->where($dataObjectsItemMatch);
		    
		    $query = $query->dataQuery()->query();

		    
		    $query->addSelect(array('Relevance' => $dataObjectsItemMatch));
		            
		    $records = DB::query($query->sql());
		    
		 
		  
		    foreach( $records as $record ) $objects[] = new $record['ClassName']($record);
		
		    $dataObjects->merge($objects);
		 }
		 
		  foreach($objects AS $object) { 
			 foreach($data as $key=>$value){
		         if($object->ClassName == $key) {
		         	$value->push($object);
		         }
	         }    
          }

		   
		 
	    $pages->sort(array(
	      'Relevance' => 'DESC',
	      'Title' => 'ASC'
	    ));
	   $dataObjects->sort(array(
	      'Relevance' => 'DESC',
	      'Date' => 'DESC'
	    ));

	    /*
	    $data = array(
	      'Pages' => $pages,
	       'Files' => $files,
	     'DataObjects' => $dataObjects,
				'Query' => $keyword
			); 
		*/
	
	    if ( $pages->count() == 0 
	     && $dataObjects->count() == 0
	     /* && $files->count() == 0 */)
	    {
	      $data['NoResults'] = 1;
	    }
	    /*
	    foreach($data as $dataKey => $dataValue){
		      print_r($data[$dataKey]);
		      print_r("<br><br><br>");
	    }
	      return;
	     */

	   
	    return $this->customise($data)->renderWith(array('Search','Page'));
	}
	
	public function performQuery($classes, $objects, $request, $keywordArray, $extraFields, $bibliographyFlag = false){		
	     foreach ($classes as $c){
	        $ItemMatch = $this->getItemMatch($c, $request, $keywordArray, $keywordHTML, ''); //This function is in Page.php
	       
		    $query = DataList::create($c)->where($ItemMatch);
		    
		    $query = $query->dataQuery()->query();

		    
		    $query->addSelect(array('Relevance' => $ItemMatch));
		            
		    $records = DB::query($query->sql());
		    
		 
		    $objects = array();
		    foreach( $records as $record ) $objects[] = new $record['ClassName']($record);
		
		    $dataObjects->merge($objects);
		 }

	}
	
	/*Returns SQL for searching through DataObjects and Pages in the results function*/
	
	public function getItemMatch($class, $request, $keywordArray, $keywordHTML, $resultString = '', $bibSearch = false){
		
		$fields = DataObject::custom_database_fields($class);
	    $count = count($fields);
	    $iter = 0;
	    
	    $resultString = '';
	    //return $resultString;
	 
	    if ($fields){
		    foreach ($fields as $fieldValue => $fieldType){
		    	foreach ($keywordArray as $keyword){
		    		$keyword = trim($keyword);
			    	if ($iter == 0){
				    	$resultString = $fieldValue . ' LIKE ' . "'%" . $keyword. "%'";
				    	$iter++;
				    	continue;
			    	}
				     
				     if ($iter != $count){
					     $resultString .= ' OR ' . $fieldValue . ' LIKE ' . "'%" . $keyword. "%'";
					   
				     }
				     $iter++;
				 }
		     }
		    $resultString .= ' ';
	    }
	   
	    
	   
	    $mode = ' IN BOOLEAN MODE';
			
		/*$returnedString = "MATCH(" . $resultString . " ) AGAINST ('$keyword'$mode)
                    + MATCH(" . $resultString . " ) AGAINST ('$keywordHTML'$mode)";*/
		//$returnedString = 'CONCAT(' . $resultString . ") LIKE ('$keyword')";
                  
		
		return $resultString;
	}
	

	
	//Return content of page with words that appear in glossary as hypertext 
	public function filteredContent(){
		$pageContent = $this->Content;
		$wordArray = Word::get();
		foreach ($wordArray as $word){
		    $allLowerCaseWord = strtolower($word->Word);
		    $wordID = $word->ID;
		    $newHTML = "<div id=" . $word->Word . " class='white-popup mfp-hide'>" . $word->Definition . "</div>";
			$newHTML .= '<a class="open-glossary-popup" href="#' . $word->Word . '">' . $allLowerCaseWord . '</a>';
			$pageContent = str_replace($allLowerCaseWord, $newHTML, $pageContent);
			//$str = strtolower($str);
			
			$firstLetterUpperWord = ucwords($word->Word);
			$newHTML = "<div id=" . $word->Word . " class='white-popup mfp-hide'>" . $word->Definition . "</div>";
			$newHTML .= '<a class="open-glossary-popup" href="#' . $word->Word . '">' . $firstLetterUpperWord . '</a>';
			$pageContent = str_replace($firstLetterUpperWord, $newHTML, $pageContent);
		}
		
		$pageContent .= '<p><a class="open-glossary-popup" href="#fig">asdas</a></p>';
		
		return $pageContent;
	}
	
		
		
		
		
		
	
		public function search()
		{       
		  if($this->request && $this->request->requestVar('Search')) {
		    $searchText = $this->request->requestVar('Search');
		  }else{
		    $searchText = 'Search';
		  }
	
		  $f = new TextField('Search', false, $searchText);
	
		  $fields = new FieldList(
		    $f
		  );
		  $actions = new FieldList(
		    new FormAction('results', 'Go')
		  );
		  $form = new Form(
		    $this,
		    'search',
		    $fields,
		    $actions
		  );
		  //$form->disableSecurityToken();
		  $form->setFormMethod('GET');
		  $form->setTemplate('SearchForm');

		  return $form;
		}
	
	
	
        
	public function queryTest(){
		$query = new SearchQuery();
		
		$query->search('Cone', 'SiteTree_Title');
		//print_r($query);
		$results = singleton('MyIndex')->search($query);
		print_r($results);
		//sleep(5);
		//print_r("HI");
		return;
	}
	
	public function fieldPhotoHandler($arguments){
		
	     if (isset($arguments["ID"])){
		    $photoID = $arguments["ID"];
	    }
	    else {
		    return;
	    }
	    
	    $customise = array();
	    
	    if (isset($arguments["size"])){
		    $customise['size'] = $arguments["size"] . 'Image';
	    }
	    else {
		    $customise['size'] = 'normal';
	    }
	  
	    
	    
		$photoObject = DataObject::get_by_id("FieldPhoto", $photoID);
		$picture = $photoObject->Picture();
		
		
		
		$customise["picture"] = $picture;
	    
		$customise['filename'] = $picture->getFilename();
		
		$template = new SSViewer('FieldPhoto');
		
		return $template->process(new ArrayData($customise));
		
		//print_r($filename);
	    //$pictureHTML = '<img src="' . $filename . '" . width="' . $photoWidth . '" height="' . $photoHeight . '"/>';
		//
		return $pictureHTML;		
	}
	
	
	public function artPhotoHandler($arguments){
		 if (isset($arguments["ID"])){
		    $photoID = $arguments["ID"];
	    }
	    else {
		    return;
	    }
	    
	    $customise = array();
	    
	    if (isset($arguments["size"])){
		    $customise['size'] = $arguments["size"] . 'Image';
	    }
	    else {
		    $customise['size'] = 'normal';
	    }
	  
	    
	    
		$photoObject = DataObject::get_by_id("ArtPhoto", $photoID);
		$picture = $photoObject->Picture();
		
		
		
		$customise["picture"] = $picture;
		
		$customise["CreditLine"] = $photoObject->CreditLine;
	    
		$customise['filename'] = $picture->getFilename();
		
		$template = new SSViewer('ArtPhoto');
		
		return $template->process(new ArrayData($customise));
		
		//print_r($filename);
	    //$pictureHTML = '<img src="' . $filename . '" . width="' . $photoWidth . '" height="' . $photoHeight . '"/>';
		//
		return $pictureHTML;		
	}

/**
   * Process and render search results.
   *
   * !! NOTE
   * _config.php includes:
   * 
   * FulltextSearchable::enable();
   * Object::add_extension('ExtendedPage', "FulltextSearchable('HeadlineText')");
   * Object::add_extension('NewsStory', "FulltextSearchable('Name,Content')");
   * !!
   * 
   * @param array $data The raw request data submitted by user
   * @param Form $form The form instance that was submitted
   * @param SS_HTTPRequest $request Request generated for this action
   */
  

	
}