<?php
 
class Subtopic extends Page {
 
  
  private static $db = array(	
  'Name' => 'Varchar',
  'Description' => 'Text',
  'Tags' => 'Text'
  );

  
   private static $many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'MediaPieces' => 'MediaPiece',
   'Photos' => 'Photo'

  
  );
  
 
  
  private static $belongs_many_many = array(
  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 	
 		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Topic Name'));
		$fields->addFieldToTab('Root.Main', new TextField('Description', 'Topic Description'));
		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
		
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		
		
		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);
		
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
		
		$gridFieldConfigMediaPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("MediaPieces", "MediaPieces", $this->MediaPieces(), $gridFieldConfigMediaPieces);
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		$gridFieldConfigPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Photos", "Photos", $this->Photos(), $gridFieldConfigPhotos);
		$fields->addFieldToTab('Root.Photos', $gridfield);
		
		
		return $fields;		
 	
		
  }
  
    public function onBeforeWrite(){
    
	    $publishPage = $this->IsPublished();
	  	
	  	if (isset($publishPage)){
			if (!$publishPage){
				$subtopicParent = SubtopicHolder::get()->First();
				$this->setParent($subtopicParent);
				
			}
		}
		
		parent::onBeforeWrite();
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
	private static $allowed_actions = array ();
	
	
	
}
