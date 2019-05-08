<?php

use SilverStripe\ORM\PaginatedList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Assets\Image;
class EssayHolderController extends PageController {

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
	private static $allowed_actions = array ('show', 'getPaginatedPages');
	
	public static $childPage = 'Essay';

	public function essaysByAuthor(){
		$essays = Essay::get();
		$essays->sort('Author', 'DESC');
		return $essays;
	}
	
	//Called by show template
	public function getPaginatedPages($relation = 'EssayPages'){
		$ID = $this->request->param('ID');
		$object = Essay::get()->byID($ID);

		if($object){
			$relation = $object->EssayPages();
			$list = new PaginatedList($relation, $this->request);
			$list->setPageLength(1);
			return $list;
		}else{
			return false;
		}
	}
	
	public function getEssayImages(){
		 $ID = $this->request->param('ID');
		 $object = Essay::get()->byID($ID);

		 if($object){
		 $relation = $object->EssayPages();
		 
		 $essayImages = new ArrayList();
		 
		 foreach($relation as $page){
			 $content = $page->Content;
			 $pattern = '/[A-Z]{3}[0-9]{1,3}[" "]?[A-Z]?[0-9]?/';
			 preg_match($pattern, $content, $matches, PREG_OFFSET_CAPTURE);
			 foreach ($matches as $match){	 
			 	$newImage = Image::get()->filter(array('Title' => $match))->first();
			 	if ($newImage){
				 	$essayImages->add($newImage);
			 	}
			 }
		 }
		 return $essayImages;
		}else{
			return false;
		}
	}
	
	public function getEssays () {
		$essays = Essay::get()->sort('Title');
		return $essays;
	}
}