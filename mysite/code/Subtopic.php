<?php
 
class Subtopic extends Page {
 
  
  public static $db = array(	
  'Name' => 'Varchar',
  'Description' => 'Text',
  'Tags' => 'Text'
  );

  
   public static $many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'MediaPieces' => 'MediaPiece',
   'Photos' => 'Photo'

  
  );
  
  public static $belongs_many_many = array(
  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 	
 		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Topic Name'));
		$fields->addFieldToTab('Root.Main', new TextField('Description', 'Topic Description'));
		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigPeople->addComponent(new GridFieldBulkEditingTools());
		$gridFieldConfigPeople->addComponent(new GridFieldBulkImageUpload());     
		
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
					
		$fields->addFieldToTab('Root.People', $gridfield);
		
		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigEssays->addComponent(new GridFieldBulkEditingTools());
		$gridFieldConfigEssays->addComponent(new GridFieldBulkImageUpload());     
		
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);
					
		$fields->addFieldToTab('Root.Essays', $gridfield);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigCountries->addComponent(new GridFieldBulkEditingTools());
		$gridFieldConfigCountries->addComponent(new GridFieldBulkImageUpload());     
		
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigEssays);
					
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
		$gridFieldConfigMediaItems= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigMediaItems->addComponent(new GridFieldBulkEditingTools());
		$gridFieldConfigMediaItems->addComponent(new GridFieldBulkImageUpload());     
		
		$gridfield = new GridField("MediaPieces", "MediaPieces", $this->MediaPieces(), $gridFieldConfigEssays);
					
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		
		
		return $fields;		
 	
		
  }
  

}


class Subtopic_Controller extends Page_Controller {

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
