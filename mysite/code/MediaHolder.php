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


	public function loadDefaultResults(){
		/* --------------------- */
		/* --- DOESNT WORK 1 --- */
		/* --------------------- */
		/*$media = DataList::create('DataObject');

		$media->filter(
    		'ClassName', array('MediaPiece', 'Image'))->sort('RAND()');

		return $media;
		*/

		/* --------------------- */
		/* --- DOESNT WORK 2 --- */
		/* --------------------- */
		/*$media = DataObject::get()->filter(
    		'ClassName', array('MediaPiece', 'Image'))->sort('RAND()');

    	return $media;*/

    	/* --------------------- */
    	/* --- DOESNT WORK 3 --- */
    	/* --------------------- */

		/*$results = new ArrayList();

		$media = MediaPiece::get();
		$images = $this->loadDefaultImageResults();


		foreach($media as $mediaPiece) $results->push($mediaPiece);
		foreach($images as $image) $results->push($image); 

		$resultsArray = $results->toArray();

		shuffle($resultsArray);


		$resultsShuffled = new ArrayList($resultsArray);

		return $resultsShuffled;*/


    	/* -------------------------- */
    	/* --- Temporary Solution --- */
    	/* -------------------------- */

    	$results = $this->loadDefaultImageResults();
    	return $results;


	}

	public function loadDefaultImageResults(){
		$results = Image::get()->filter(array('HideFromMediaGrid' => 'false'))->sort('RAND()');
		$paginatedMediaList = new PaginatedList($results, $this->request);
		$paginatedMediaList->setPageLength(20);
		return $paginatedMediaList;


	}

	public function getResults(){

		$filters = $this->getFilters();

		/* Filter by Media Type first-- then everything else */

		if($filters['MediaType'] != ''){

			if($filters['MediaType'] == 'AudioPiece'){
				$results = AudioPiece::get();
			}elseif ($filters['MediaType'] == 'VideoPiece') {
				$results = VideoPiece::get();
			}elseif(($filters['MediaType'] == 'ArtPhoto')||($filters['MediaType']=='FieldPhoto')) {
				$results = $this->loadDefaultImageResults();
				$results = $results->addFilter((array('Type' => $filters['MediaType'])));
			}elseif($filters['MediaType'] == 'Image') {
				$results = $this->loadDefaultImageResults();
			}elseif($filters['MediaType'] == 'AllMedia'){
				$results = $this->loadDefaultResults();

			}

			}else {
				$results = $this->loadDefaultResults();
			}

		/* Everything Else */

		if($filters['Country'] != ''){
			$results = $results->filter((array('Countries.ID' => $filters['Country'])));
		}

		if($filters['People'] != ''){
			$results = $results->filter((array('People.ID' => $filters['People'])));
		}

		if($filters['Chapter'] != ''){
			$results = $results->filter((array('Chapters.ID' => $filters['Chapter'])));
		}
		if($filters['Subtopic'] != ''){
			$results = $results->filter((array('Subtopics.ID' => $filters['Subtopic'])));
		}


		//$results = $results->sort('RAND()');

		//Only paginate images, not other media. 

		return $results;

		
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

		if (isset($startParam) && Director::is_ajax()){
			$returnList = $this->getResults()->limit(20, $startParam);
			$returnList->sort('RAND()');
			
			$template = new SSViewer('LoadNewMedia');
			return $this->customise(array("imageList"=>$returnList))->renderwith('LoadNewMedia');
		}
		//if ?start is set, but we aren't in an ajax request send the user to the media homepage.
		elseif(isset($startParam)) {
			$this->redirect('media/');
		}

		else{
			
			return $this->renderWith(array('MediaHolder', 'Page'));
			
		}

	}
	
	public function hasAudio() {
		  $audioPieces = AudioPiece::get()->First();
		  return $audioPieces;
	}


    /*public function filter() {
        //return new MediaFilterForm($this, 'filters');
        $this->renderWith(array('MediaHolder', 'Page'));
    }	*/

	public function MediaFilterForm(){
		return new MediaFilterForm($this, 'index', $this->getFilters());
	}

	
	
	
}
