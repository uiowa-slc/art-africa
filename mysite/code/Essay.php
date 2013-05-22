<?php
 
class Essay extends Page {
 
  
  private static $db = array(
  'Author' => 'Text',	
  'Content' => 'Text',	
  'DateWritten' => 'Text',	
  'University' => 'Text',	
  'Consultant' => 'Text',	
  'Title' => 'Text',	
  'Source' => 'Text',	
  'Bibliography' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  
  private static $many_many = array(
  'MediaPieces' => 'MediaPiece'
  );
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Countries' => 'Country',
  'People' => 'People',
  'Photos' => 'Photo'
  
  );
  


  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Title'));
 		$fields->addFieldToTab('Root.Main', new TextField('Author', 'Author'));
 		$fields->addFieldToTab('Root.Main', new TextField('Content', 'Content'));
 		$fields->addFieldToTab('Root.Main', new TextField('DateWritten', 'Date Written'));
 		$fields->addFieldToTab('Root.Main', new TextField('University', 'University'));
 		$fields->addFieldToTab('Root.Main', new TextField('Consultant', 'Consultant'));
 		$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));
 		$fields->addFieldToTab('Root.Main', new TextField('Bibliography', 'Bibliography'));
		
		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
			
		$gridFieldConfigMediaPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("MediaPieces", "MediaPieces", $this->MediaPieces(), $gridFieldConfigMediaPieces);
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		$gridFieldConfigPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Photos", "Photos", $this->Photos(), $gridFieldConfigPhotos);
		$fields->addFieldToTab('Root.Photos', $gridfield);
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		

		
		
		
		
		return $fields;		
  }
  
   public function onBeforeWrite(){
   
   	  $publishPage = $this->IsPublished();
  	
   	  if (isset($publishPage)){
			if (!$publishPage){
			  $essayParent = EssayHolder::get()->First();
			  $this->setParent($essayParent);
			}
	  }
	  parent::onBeforeWrite();
  }
  
  
}


class Essay_Controller extends Page_Controller {

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
