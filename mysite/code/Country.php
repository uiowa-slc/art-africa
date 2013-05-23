<?php
 
class Country extends DataObject {
 
  
  private static $db = array(	
  'Name' => 'Text',
  'Location' => 'Text',
  'DateOfIndependence' => 'Text',
  'Nationality' => 'Text',
  'CapitalCity' => 'Text',
  'Population' => 'Text',
  'ImportantCities' => 'Text',
  'HeadOfState' => 'Text',
  'Area' => 'Text',
  'TypeOfGovernment' => 'Text',
  'Currency' => 'Text',
  'MajorPeoples' => 'Text',
  'Religion' => 'Text',
  'Climate' => 'Text',
  'Literacy' => 'Text',
  'OfficialLanguage' => 'Text',
  'PrincipalLanguage' => 'Text',
  'MajorExports' => 'Text',
  'PrecolonialHistory' => 'Text',
  'PostcolonialHistory' => 'Text',
  'Tags' => 'Text'
  
  
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  
  );
  
  private static $searchable_fields = array(
  'Name'
  );
  
  private static $many_many = array(
  'People' => 'People',
  'Essays' => 'Essay',
  'MediaPieces' => 'MediaPiece',
  'Photos' => 'Photo'
  );
  
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic'
  
  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID', 'Temporary ID Field'));
 		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
 		$fields->addFieldToTab('Root.Main', new TextField('DateOfIndependence', 'Date Of Independence'));
 		$fields->addFieldToTab('Root.Main', new TextField('Nationality', 'Nationality'));
 		$fields->addFieldToTab('Root.Main', new TextField('CapitalCity', 'Capital City'));
 		$fields->addFieldToTab('Root.Main', new TextField('Population', 'Population'));
 		$fields->addFieldToTab('Root.Main', new TextField('ImportantCities', 'Important Cities'));
 		$fields->addFieldToTab('Root.Main', new TextField('HeadOfState', 'Head Of State'));
 		$fields->addFieldToTab('Root.Main', new TextField('Area', 'Area'));
 		$fields->addFieldToTab('Root.Main', new TextField('TypeOfGovernment', 'Type Of Government'));
 		$fields->addFieldToTab('Root.Main', new TextField('Currency', 'Currency'));
 		$fields->addFieldToTab('Root.Main', new TextField('MajorPeoples', 'Major Peoples'));
 		$fields->addFieldToTab('Root.Main', new TextField('Religion', 'Religion'));
 		$fields->addFieldToTab('Root.Main', new TextField('Climate', 'Climate'));
 		$fields->addFieldToTab('Root.Main', new TextField('Literacy', 'Literacy'));
 		$fields->addFieldToTab('Root.Main', new TextField('OfficialLanguage', 'Official Language'));
 		$fields->addFieldToTab('Root.Main', new TextField('PrincipalLanguage', 'Principal Language'));
 		$fields->addFieldToTab('Root.Main', new TextField('MajorExports', 'Major Exports'));
 		$fields->addFieldToTab('Root.Main', new TextField('PrecolonialHistory', 'Precolonial History'));
 		$fields->addFieldToTab('Root.Main', new TextField('PostcolonialHistory', 'Postcolonial Language'));
 		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
 		
 		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);
		
		$gridFieldConfigMediaPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("MediaPieces", "MediaPieces", $this->MediaPieces(), $gridFieldConfigMediaPieces);
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		$gridFieldConfigPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Photos", "Photos", $this->Photos(), $gridFieldConfigPhotos);	
		$fields->addFieldToTab('Root.Photos', $gridfield);
		
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		
		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		
 		
		return $fields;		
  }
  
}

