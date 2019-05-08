<?php
class BibliographyHolderController extends PageController {

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
	
	public static $childPage = 'BibliographyPage';

	//Jump to first Bibliography Page upon index.
	public function index(){
		$firstChild = $this->Children()->First();

		if($firstChild){
			$this->redirect($firstChild->Link());
		} else{
			parent::index();
		}
	}
	

	
}