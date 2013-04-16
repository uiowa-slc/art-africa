<?php
class SubTopicPage extends Page {

	public static $default_parent = "TopicPage";
	
	public static $many_many = array(
	    	'CollectionPieces' => 'CollectionPiece'
	);
	public function getCMSFields() {

	   	$fields = parent::getCMSFields();
			
		$gridFieldConfig = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfig->addComponent(new GridFieldBulkEditingTools());
		$gridFieldConfig->addComponent(new GridFieldBulkImageUpload());   
		/*$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    */
		
		$gridfield = new GridField("CollectionPieces", "Collection Pieces", $this->CollectionPieces(), $gridFieldConfig);
					
		$fields->addFieldToTab('Root.CollectionPieces', $gridfield);

			
		return $fields;		
	}

}
class SubTopicPage_Controller extends Page_Controller {

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