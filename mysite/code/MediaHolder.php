<?php
 
class MediaHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  //private static $allowed_children = array("AudioPiece", "VideoPiece");
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  		
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","Content");
		//$fields->addFieldToTab("Root.Main")
		$content = new HTMLEditorField("Content", "Content -- Use this field to edit the introduction to the audio and video that shows up on the front-end of the site.  Use the Audio and Video pages to edit the photos themselves.");
		$fields->addFieldToTab("Root.Main", $content);
		return $fields;	
  }
  

}


class MediaHolder_Controller extends Page_Controller {

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
	private static $allowed_actions = array ("doFilter", "filters");
	//This function apparently isn't being used.. yet.
/*	public function show ($request){
					
		$otherClass = 'Media';

		$sourceID = $request->source;

		if($sourceID){
			$source = SiteTree::get_by_id("Page", $sourceID);
		}
		$objectID = $this->request->param('ID');
		if ($objectID){
		
		    $object = $otherClass::get_by_id($otherClass, $objectID);
		    
		    if(isset($object)){

		    	$data = array (
		    		"object" => $object,
		    		"source" => $source
		    		);
		    	
		       $showTemplate = $class . 'Holder_show';
			   return $this->Customise($data)->renderWith(array($showTemplate, 'Page'));
			   
		    }else{
		    }		   
		}
		else {
			return $this->renderWith('Page');
		}
	
	}*/
	public function getImages(){
		/*$images = new ArrayList();
		$artPhotoImages = Image::get()->filter(array('Type' => 'ArtPhoto'));
		$fieldPhotoImages = Image::get()->filter(array('Type' => 'FieldPhoto'));
		$images->merge($artPhotoImages);
		$images->merge($fieldPhotoImages);*/

		$filters = $this->getFilters();

		$images = Image::get()->filter(array('HideFromMediaGrid' => 'false'));

		if($filters['Country'] != ''){
			$images = $images->addFilter((array('Countries.ID' => $filters['Country'])));
		}

		if($filters['People'] != ''){
			$images = $images->addFilter((array('Peoples.ID' => $filters['People'])));
		}

		if($filters['Chapter'] != ''){
			$images = $images->addFilter((array('Chapters.ID' => $filters['Chapter'])));
		}
		if($filters['Subtopic'] != ''){
			$images = $images->addFilter((array('Subtopics.ID' => $filters['Subtopic'])));
		}

		if($filters['MediaType'] != ''){
			$images = $images->addFilter((array('Type' => $filters['MediaType'])));
		}

		$images = $images->sort('RAND()');

		$paginatedImageList = new PaginatedList($images, $this->request);
		$paginatedImageList->setPageLength(20);
		
		return $paginatedImageList;
	}

	public function getFilters(){

		$getVars = $this->request->getVars();

		$filters = array(
			"Country" => "",
			"People" => "",
			"Subtopic" => "",
			"Chapter" => "",
			'MediaType' => ""
			);

		foreach($getVars as $key=>$value){
			$filters[$key] = "".$value;
		}

		return $filters;


	}
	
	public function index(){

		//print_r($this->request);

		$getVars = $this->request->getVars();
		
		if (isset($getVars['start'])){
			$startParam = $getVars['start'];
		}

		if (isset($startParam)){
			$returnList = $this->getImages()->limit(20, $startParam);
			$returnList->sort('RAND()');
			
			$template = new SSViewer('LoadNewMedia');
			return $this->customise(array("imageList"=>$returnList))->renderwith('LoadNewMedia');
		}
		else {
			
			return $this->renderWith(array('MediaHolder', 'Page'));
			
		}

	}


    /*public function filter() {
        //return new MediaFilterForm($this, 'filters');
        $this->renderWith(array('MediaHolder', 'Page'));
    }	*/

	public function MediaFilterForm(){
		return new MediaFilterForm($this, 'index', $this->getFilters());
	}

	
	
	
}
