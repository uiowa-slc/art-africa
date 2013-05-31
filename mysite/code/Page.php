<?php
class Page extends SiteTree {

	private static $db = array(
		/*"Keywords" => "Text" */
	);

	private static $has_one = array(
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
	
	function results($data, $form, $request)
	  {	
	  	
	    $keyword = trim($request->requestVar('Search'));
	    $keyword = Convert::raw2sql($keyword);
	    $keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');    
	        
	    $pages = new ArrayList();
	    $dataObjects = new ArrayList();
	    $files = new ArrayList();
	    
	        
	    $siteTreeClasses = array('Chapter', 'Subtopic'); //add in an classes that extend Page or SiteTree
	    $dataObjectClasses = array('Country', 'Essay', 'People');
	    


	    
	    /*
	     * Standard pages
	     * SiteTree Classes with the default search MATCH
	     */
	    foreach ( $siteTreeClasses as $c )
	    {
	      $siteTreeMatch = $this->getItemMatch($c, $request, $keyword, $keywordHTML, 'Title, MenuTitle, '); //This function is in Page.php
	      $query = DataList::create($c)
	       // ->filter(array('RootLanguageParentID' => $this->RootLanguageParentID))
	        ->where($siteTreeMatch);

	      $query = $query->dataQuery()->query();
	     	      
	      $query->addSelect(array('Relevance' => $siteTreeMatch));
	      
	    
	      $records = DB::query($query->sql());
	    
		
	      $objects = array();
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
	        $dataObjectsItemMatch = $this->getItemMatch($c, $request, $keyword, $keywordHTML, ''); //This function is in Page.php
		    $query = DataList::create($c)->where($dataObjectsItemMatch);
		    
		    $query = $query->dataQuery()->query();
		    $query->addSelect(array('Relevance' => $dataObjectsItemMatch));
		            
		    $records = DB::query($query->sql());
		    
		    $objects = array();
		    foreach( $records as $record ) $objects[] = new $record['ClassName']($record);
		
		    $dataObjects->merge($objects);
		 }
		   
		 
	
	    $pages->sort(array(
	      'Relevance' => 'DESC',
	      'Title' => 'ASC'
	    ));
	   $dataObjects->sort(array(
	      'Relevance' => 'DESC',
	      'Date' => 'DESC'
	    ));

	    
	    $data = array(
	      'Pages' => $pages,
	       'Files' => $files,
	     'DataObjects' => $dataObjects,
				'Query' => $keyword
			); 
	
	    if ( $pages->count() == 0 
	     && $dataObjects->count() == 0
	     /* && $files->count() == 0 */)
	    {
	      $data['NoResults'] = 1;
	    }
	    
	   
	    return $this->customise($data)->renderWith(array('Search','Page'));
	}
	
	/*Returns SQL for searching through DataObjects and Pages in the results function*/
	
	public function getItemMatch($class, $request, $keyword, $keywordHTML, $resultString = ''){
		
		$fields = DataObject::custom_database_fields($class);
	    $count = count($fields);
	    $iter = 1;
	    
	    foreach ($fields as $fieldValue => $fieldType){
		     $resultString .= $fieldValue;
		     if ($iter != $count){
			     $resultString .= ', ';
			     $iter++;
		     }
	     }
	    $resultString .= ' ';
	    
	   
	    $mode = ' IN BOOLEAN MODE';
			
		$returnedString = "MATCH(" . $resultString . " ) AGAINST ('$keyword'$mode)
                    + MATCH(" . $resultString . " ) AGAINST ('$keywordHTML'$mode)";

		return $returnedString;
	}
	
	public function filteredContent(){
		$pageContent = $this->Content;
		$wordArray = Word::get();
		foreach ($wordArray as $word){
			$newHTML = '<a href="#">' . $word->Word . ' </a>';
			$pageContent = str_replace($word->Word, $newHTML, $pageContent);
		}
		
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