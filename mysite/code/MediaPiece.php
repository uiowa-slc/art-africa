<?php
 
class MediaPiece extends DataObject {
 
  
  private static $db = array(	
  'History' => 'Text',
  'Bibliography' => 'Text'

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $belongs_many_many = array(
  'People' => 'People',
  'Essays' => 'Essay',
  'Photos' => 'Photo',
  'Countries' => 'Country',
  'Subtopics' => 'Subtopic'
  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new TextField('History', 'History'));
 		$fields->addFieldToTab('Root.Main', new TextField('Bibliography', 'Bibliography'));

 		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		
		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);
		
		$gridFieldConfigPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Photos", "Photos", $this->Photos(), $gridFieldConfigPhotos);
		$fields->addFieldToTab('Root.Photos', $gridfield);
		

 		
		return $fields;		
  }
  
}


