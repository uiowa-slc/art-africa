<?php
 
class BibliographyHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
   
  private static $allowed_children = array("BibliographyPage");
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		
		return $fields;		
  }
  

}


class BibliographyHolder_Controller extends Page_Controller {

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
