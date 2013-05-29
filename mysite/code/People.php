<?php
 
class People extends DataObject {
 
  
  private static $db = array(	
  'Name' => 'Text',
  'Location' => 'Text',
  'Languages' => 'Text',
  'Population' => 'Text',
  'Neighbors' => 'Text',
  'TypesOfArt' => 'Text',
  'History' => 'Text',
  'Economy' => 'Text',
  'PoliticalSystems' => 'Text',
  'Religion' => 'Text'

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $many_many = array(
  'Essays' => 'Essay',
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  'ArtPhotos' => 'ArtPhoto',
  'FieldPhotos' => 'FieldPhoto'
  
  );
  
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Countries' => 'Country'

  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 				
		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Name'));
		$fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
		$fields->addFieldToTab('Root.Main', new TextField('Languages', 'Languages'));
		$fields->addFieldToTab('Root.Main', new TextField('Population', 'Population'));
		$fields->addFieldToTab('Root.Main', new TextField('Neighbors', 'Neighbors'));
		$fields->addFieldToTab('Root.Main', new TextField('TypesOfArt', 'Types Of Art'));
		$fields->addFieldToTab('Root.Main', new TextField('History', 'History'));
		$fields->addFieldToTab('Root.Main', new TextField('Economy', 'Economy'));
		$fields->addFieldToTab('Root.Main', new TextField('PoliticalSystems', 'Political Systems'));
		$fields->addFieldToTab('Root.Main', new TextField('Religion', 'Religion'));
		
		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);
				
		$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("AudioPieces", "Audio Pieces", $this->AudioPieces(), $gridFieldConfigAudioPieces);
		$fields->addFieldToTab('Root.AudioPieces', $gridfield);
		
		$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("VideoPieces", "Video Pieces", $this->VideoPieces(), $gridFieldConfigVideoPieces);
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);
		
		$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
		$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("FieldPhotos", "Field Photos", $this->FieldPhotos(), $gridFieldConfigFieldPhotos);
		$fields->addFieldToTab('Root.FieldPhotos', $gridfield);
		
		
		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);

		
		return $fields;		
  }
}



  
  




