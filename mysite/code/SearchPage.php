<?php
class SearchPage extends Page {

   public static $allowed_children = array(
    	
   );
  
   public function getCMSFields() {
	   
   	$fields = parent::getCMSFields();
		
	/*$gridFieldConfig = GridFieldConfig_RelationEditor::create(); 
	$gridFieldConfig->addComponent(new GridFieldBulkEditingTools());
	$gridFieldConfig->addComponent(new GridFieldBulkImageUpload());   
	$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    
	
	$gridfield = new GridField("SubTopicPages", "Sub Topic Pages", $this->SubTopicPages()->sort("SortOrder"), $gridFieldConfig);
				
	$fields->addFieldToTab('Root.Subtopics', $gridfield);*/
		
	return $fields;		
  }

}
class SearchPage_Controller extends Page_Controller {

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

	public function init() {
		parent::init();

	}
	

}