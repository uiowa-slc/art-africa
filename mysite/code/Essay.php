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
  'Bibliography' => 'Text',
  'Tags' => 'Text'
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
 		
 		 //$fields->removeByName('');
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Title'));
 		$fields->addFieldToTab('Root.Main', new TextField('Author', 'Author'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Content', 'Content'));
 		$fields->addFieldToTab('Root.Main', new TextField('DateWritten', 'Date Written'));
 		$fields->addFieldToTab('Root.Main', new TextField('University', 'University'));
 		$fields->addFieldToTab('Root.Main', new TextField('Consultant', 'Consultant'));
 		$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Bibliography', 'Bibliography'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
 		
 			
		$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
		$gridFieldConfigArtPhotosViewer= GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("ArtPhotosViewer", "View All Art Photos", ArtPhoto::get(), $gridFieldConfigArtPhotosViewer);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
		$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("AudioPieces", "Audio Pieces", $this->AudioPieces(), $gridFieldConfigAudioPieces);
		$fields->addFieldToTab('Root.AudioPieces', $gridfield);
		
		$gridFieldConfigAudioPiecesViewer= GridFieldConfig_RecordEditor::create(); 
		$gridfieldViewer = new GridField("AudioPiecesViewer", "View All Audio Pieces", AudioPiece::get(), $gridFieldConfigAudioPiecesViewer);
		$fields->addFieldToTab('Root.AudioPieces', $gridfieldViewer);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
		$gridFieldConfigCountriesViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("CountriesViewer", "View All Countries", Country::get(), $gridFieldConfigCountriesViewer);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
		$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("FieldPhotos", "Field Photos", $this->FieldPhotos(), $gridFieldConfigFieldPhotos);
		$fields->addFieldToTab('Root.FieldPhotos', $gridfield);
		
		$gridFieldConfigFieldPhotosViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("FieldPhotosViewer", "View All Field Photos", FieldPhoto::get(), $gridFieldConfigFieldPhotosViewer);
		$fields->addFieldToTab('Root.FieldPhotos', $gridfield);
				

		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		
		$gridFieldConfigPeopleViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("PeopleViewer", "View All People", People::get(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
	
		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigSubtopicsViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("SubtopicsViewer", "View All Subtopics", Subtopic::get(), $gridFieldConfigSubtopicsViewer);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);

		$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("VideoPieces", "Video Pieces", $this->VideoPieces(), $gridFieldConfigVideoPieces);
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);
		
		$gridFieldConfigVideoPiecesViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("VideoPiecesViewer", "View All Video Pieces", VideoPiece::get(), $gridFieldConfigVideoPiecesViewer);
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);
	
		
	
		

		
		
		
		
		return $fields;		
  }
  

  
  
}


