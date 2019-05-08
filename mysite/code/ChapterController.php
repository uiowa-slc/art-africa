
<?php

class ChapterController extends PageController {

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
	private static $allowed_actions = array ();
	
	public function getNextChapter(){
	
		$chapterHolder = $this->getParent();
		$chapters = $chapterHolder->Children();
				
		$check = false; //true when match for chapter found
				
			foreach($chapters as $loopChapter){
			
				if ($check == true){
					$returnedItem = $loopChapter;
									
					$check = false;
				}
				if ($loopChapter->Title == $this->Title){
					$check = true;
				}	
				
			}		
		
		
		if (!isset($returnedItem)){
			//We're in the last chapter, so return the first chapter's link or title
			$returnedItem = Chapter::get()->First();
		}
	    
	    if (isset($returnedItem)){
			return $returnedItem;
		}
	}
	
	public function hasChildren(){
		$children = $this->Children()->First(); //just $this->Children returns an empty ArrayList that evaluates to true

		if ($children){
			return true;
		}
		else {
			return false;
		}
	}

	public function nextPageInTree() {

		$page = $this->Children()->First();
		return $page;
	}
}