<?php
 
class Photo extends Page {
 
  
  private static $db = array(
  'Description' => 'Text',
  'TraditionalName' => 'Text',
  'Material' => 'Text',
  'Size' => 'Text',
  'Function' => 'Text',
  'Style' => 'Text',
  'Substyle' => 'Text',
  'Collection' => 'Text',
  'Source' => 'Text',	
  'Tags' => 'Text'

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $has_many = array(
  'Essays' => 'Essay',
  'MediaPieces' => 'MediaPiece'
  );

  
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Countries' => 'Country',
  'People' => 'People'
  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		return $fields;		
  }
  
  
  

}


class Photo_Controller extends Page_Controller {

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
	
	
	
}
