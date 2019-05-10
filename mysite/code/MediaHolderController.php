<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;
use SilverStripe\ORM\ArrayList;
class MediaHolderController extends PageController {

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
	private static $allowed_actions = array ('doFilter', 'filters');
	//This function apparently isn't being used.. yet.


	public function loadDefaultResults(){
    	$results = $this->loadDefaultImageResults();
    	return $results;
	}

	public function loadDefaultImageResults(){
		$results = Image::get()->filter(array(
			'HideFromMediaGrid' => false,
			'ParentImageID' => 0
		))->sort('RAND()');
		$paginatedMediaList = new PaginatedList($results, $this->getRequest());
		$paginatedMediaList->setPageLength(20);
		return $paginatedMediaList;

	}

	public function getResults(){

		$filters = $this->getFilters();
		// $results = $this->loadDefaultResults();
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
		// print_r($results);
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

		if($filters['ObjectType'] != ''){
			$results = $results->filter((array('ObjectTypes.ID' => $filters['ObjectType'])));
		}
		if($filters['ObjectMedium'] != ''){
			$results = $results->filter((array('ObjectMediums.ID' => $filters['ObjectMedium'])));
		}

		if($filters['ObjectMuseum'] != ''){
			$results = $results->filter((array('ObjectMuseums.ID' => $filters['ObjectMuseum'])));
		}
		if($filters['ObjectCollection'] != ''){
			$results = $results->filter((array('ObjectCollections.ID' => $filters['ObjectCollection'])));
		}
		if($filters['CreditLine'] != ''){
			$results = $results->filter((array('Caption:PartialMatch' => $filters['CreditLine'])));
		}

		if($filters['Photographer'] != ''){
			$results = $results->filter((array('Photographer:PartialMatch' => $filters['Photographer'])));
		}
		//$results = $results->sort('RAND()');

		//Only paginate images, not other media. 

		return $results;

		
	}

	public function getFilters(){

		$getVars = $this->request->getVars();

		$filters = array(
			'Country' => '',
			'People' => '',
			'Subtopic' => '',
			'Chapter' => '',
			'MediaType' => '',
			'ObjectType' => '',
			'Photographer' => '',
			'ObjectMuseum' => '',
			'ObjectCollection' => '',
			'CreditLine' => '',
			'ObjectTitle' => '',
			'ObjectMedium' => ''
			
			);

		foreach($getVars as $key=>$value){
			$filters[$key] = ''.$value;
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
			return $this->customise(array('imageList'=>$returnList))->renderwith('LoadNewMedia');
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
