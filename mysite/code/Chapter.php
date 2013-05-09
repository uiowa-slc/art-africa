<?php
 
class Chapter extends Page {
 
  
  public static $db = array(	
  'Name' => 'Varchar',
  'Description' => 'Text',
  'Tags' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  public static $has_one = array(

  );
  
  public static $has_many = array(
  'Subtopics' => 'Subtopic',

  );
  
  public static $belongs_many_many = array(
  
  );
  


  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Topic Name'));
		$fields->addFieldToTab('Root.Main', new TextField('Description', 'Topic Description'));
		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
		
		$gridFieldConfig = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfig->addComponent(new GridFieldBulkEditingTools());
		$gridFieldConfig->addComponent(new GridFieldBulkImageUpload());     
		
		$gridfield = new GridField("Subtopic", "Subtopics", $this->Subtopics(), $gridFieldConfig);
					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
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
	public static $allowed_actions = array ();
	
	
	
}
