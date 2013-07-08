<?php
 
class Chapter extends Page {
 
  
  private static $db = array(	
  'Description' => 'Text',
  'Tags' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  'Picture' => 'Image'
  );
  

   private static $allowed_children = array(
    	"Subtopic"
   );
  
 
  
  private static $belongs_many_many = array(
  
  );
  


  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Topic Name'), 'URLSegment');
		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Topic Description'));
		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
		
	
		
		return $fields;		
  }
  
  
  

}


class Chapter_Controller extends Page_Controller {

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
