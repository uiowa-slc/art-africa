<?php
class CollectionHolderPage extends Page {

   private static $has_many = array(
    	'CollectionPieces' => 'CollectionPiece'
   );
  
   public function getCMSFields() {
	   
   	$fields = parent::getCMSFields();
		
	$gridFieldConfig = GridFieldConfig_RecordEditor::create(); 
	$gridFieldConfig->addComponent(new GridFieldBulkEditingTools());
	$gridFieldConfig->addComponent(new GridFieldBulkImageUpload());   
	$gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));    
	
	$gridfield = new GridField("CollectionPieces", "Collection Pieces", $this->CollectionPieces()->sort("SortOrder"), $gridFieldConfig);
				
	$fields->addFieldToTab('Root.CollectionPieces', $gridfield);
		
	return $fields;		
  }

}
class CollectionHolderPage_Controller extends Page_Controller {

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
	private static $allowed_actions = array (
	'queryTest'
	);

	public function init() {
		parent::init();

		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still work
		Requirements::themedCSS('reset');
		Requirements::themedCSS('layout'); 
		Requirements::themedCSS('typography'); 
		Requirements::themedCSS('form'); 
	}
	
	public function queryTest(){
		$query = new SearchQuery();
		$query->search('Death');
		$results = singleton('MyIndex')->search($query);
		//print_r($results);
		//sleep(5);
		print_r("HI");
		return;
	}

}