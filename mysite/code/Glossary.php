<?php
 
class Glossary extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
				
		$gridFieldConfigWords = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Words", "Words", Word::get(), $gridFieldConfigWords);		
		$fields->addFieldToTab('Root.Main', $gridfield, 'Content');
		$fields->renameField('Content', 'Introduction Text');
		
		return $fields;		
  }
  
  
  

}


class Glossary_Controller extends Page_Controller {

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
