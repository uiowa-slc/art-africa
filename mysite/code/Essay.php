<?php
 
class Essay extends DataObject {
 
  
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
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  'FieldPhotos' => 'FieldPhoto',
  'ArtPhotos' => 'ArtPhoto'
  
  );
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Countries' => 'Country',
  'People' => 'People',

  
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
		
		$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("AudioPieces", "Audio Pieces", $this->AudioPieces(), $gridFieldConfigAudioPieces);
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("VideoPieces", "Video Pieces", $this->VideoPieces(), $gridFieldConfigVideoPieces);
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.Photos', $gridfield);
		
		$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("FieldPhotos", "Field Photos", $this->FieldPhotos(), $gridFieldConfigFieldPhotos);
		$fields->addFieldToTab('Root.Photos', $gridfield);
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		

		
		
		
		
		return $fields;		
  }
  

  
  
}


