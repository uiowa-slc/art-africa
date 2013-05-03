<?php
 
class MediaPiece extends Page {
 
  
  public static $db = array(	
  'History' => 'Text',
  'Bibliography' => 'Text'

  );
 
  // One-to-one relationship with gallery page
  public static $has_one = array(

  );
  
  public static $belongs_many_many = array(
  'People' => 'People',
  'Essays' => 'Essay',
  'Photos' => 'Photo',
  'Countries' => 'Country',
  'Subtopics' => 'Subtopic'
  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		return $fields;		
  }
  
  
  

}


class MediaPiece_Controller extends Page_Controller {

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
	public static $allowed_actions = array ();
	
	
	
}
