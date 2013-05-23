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
	
	
	public function show($class = 'NONE', $otherClass){
	//Displays a data object

		if ($otherClass != 'NONE') {
			$objectID = $this->request->param('ID');
			if ($objectID){
			
			    $object = $otherClass::get_by_id($otherClass, $objectID);
			    
			    if(isset($object)){
			       $showTemplate = $class . 'Holder_show';
				   return $this->Customise($object)->renderWith(array($showTemplate, 'Page'));
				   
			    }else{
			    }		   
			}
			else {
				return $this->renderWith('Page');
			}
		}
		else {
			return $this->renderWith('Page');
		}
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
function results($data, $form, $request)
  {	
  	
    $keyword = trim($request->requestVar('Search'));
    $keyword = Convert::raw2sql($keyword);
    $keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');    
        
    $pages = new ArrayList();
    $news = new ArrayList();
    $files = new ArrayList();
    
    $mode = ' IN BOOLEAN MODE';
    //$mode = ' WITH QUERY EXPANSION';
    //$mode = '';
        
    $siteTreeClasses = array('Page', 'WorkOfArt'); //add in an classes that extend Page or SiteTree
    $siteTreeMatch = "MATCH( Title, MenuTitle, Content ) AGAINST ('$keyword'$mode)
                    + MATCH( Title, MenuTitle, Content ) AGAINST ('$keywordHTML'$mode)";
        
    //custom MATCH statement for any Object that extend Page or SiteTree and have additional fields/columns that need to be searchable
    //create one block per Object
    //i.e. "MATCH( column1, column2, column3 ) AGAINST ('$keyword'$mode) + MATCH( column1, column2, column3 ) AGAINST ('$keywordHTML'$mode)"
    $extendedPageMatch = "MATCH( Keywords ) AGAINST ('$keyword'$mode)
                           + MATCH( Keywords ) AGAINST ('$keywordHTML'$mode)";
    
    //DataObject
   /* $newsItemMatch = "MATCH( Name, Content ) AGAINST ('$keyword'$mode)
                    + MATCH( Name, Content ) AGAINST ('$keywordHTML'$mode)";
    
    $fileMatch = "MATCH( Filename, Title, Content ) AGAINST ('$keyword'$mode)
                + MATCH( Filename, Title, Content ) AGAINST ('$keywordHTML'$mode)";
                */
    
    /*
     * Standard pages
     * SiteTree Classes with the default search MATCH
     */
    foreach ( $siteTreeClasses as $c )
    {
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
     * Pages with additional searchable fields
     * copy/edit this block for each Object that extend Page/SiteTree and have other columns searchable
     * see above for custom MATCH statement
     */
    $query = DataList::create('WorkOfArt')
      ->where($siteTreeMatch . ' OR ' . $extendedPageMatch);
    $query = $query->dataQuery()->query();
    $query->addSelect(array('Relevance' => $siteTreeMatch . ' OR ' . $extendedPageMatch));
    
    $records = DB::query($query->sql());
    $objects = array();
    foreach( $records as $record ) $objects[] = new $record['ClassName']($record);
    $pages->merge($objects);
    
    $pages->removeDuplicates();
    
    
    /*
     * news DataObject
     */
   /* $query = DataList::create('NewsStory')->where($newsItemMatch);
    $query = $query->dataQuery()->query();
    $query->addSelect(array('Relevance' => $newsItemMatch));
            
    $records = DB::query($query->sql());
    $objects = array();
    foreach( $records as $record ) $objects[] = new $record['ClassName']($record);
    $news->merge($objects);
    */
    /*
     * files
     */
   /* $query = DataList::create('File')->where($fileMatch);
    $query = $query->dataQuery()->query();
    $query->addSelect(array('Relevance' => $fileMatch));
    
    $records = DB::query($query->sql());
    $objects = array();
    foreach( $records as $record )
    {
      $extension = strtolower( pathinfo( $record['Name'], PATHINFO_EXTENSION ) );     
      //only return some file extensions
      if ( in_array($extension, array('xls','xlsx','doc','docx','pdf','rtf','zip','7z','rar')) )
        $objects[] = new $record['ClassName']($record);
    }
    $files->merge($objects);
    
   */   
    $pages->sort(array(
      'Relevance' => 'DESC',
      'Title' => 'ASC'
    ));
  /*  $news->sort(array(
      'Relevance' => 'DESC',
      'Date' => 'DESC'
    ));
    $files->sort(array(
      'Relevance' => 'DESC',
      'Name' => 'ASC'
    ));
    */
    $data = array(
      'Pages' => $pages,
     'News' => $news,
      'Files' => $files,
			'Query' => $keyword
		); 
    
    if ( $pages->count() == 0 
    /*  && $news->count() == 0
      && $files->count() == 0 */)
    {
      $data['NoResults'] = 1;
    }
    
    return $this->customise($data)->renderWith(array('Search','Page'));
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
}