<?php
 
class AudioPiece extends MediaPiece {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  );
  
  private static $many_many = array(
  'VideoPieces' => 'VideoPiece'
  );
  
  private static $belongs_many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'Subtopics' => 'Subtopic',
   'ArtPhotos' => 'ArtPhoto',
   'FieldPhotos' => 'FieldPhoto'
  );
  
  private static $plural_name = "Audio Pieces";

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		
		$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigArtPhotos->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create();
		$gridFieldConfigCountries->addComponent(new GridFieldManyRelationHandler()); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
			
		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigEssays->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);
		
		$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigFieldPhotos->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("FieldPhotos", "Field Photos", $this->FieldPhotos(), $gridFieldConfigFieldPhotos);
		$fields->addFieldToTab('Root.FieldPhotos', $gridfield);
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigPeople->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		
		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigSubtopics->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigVideoPieces->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("VideoPieces", "Video Pieces", $this->VideoPieces(), $gridFieldConfigVideoPieces);
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);
			
	
		

		
		return $fields;		
  }
  
  
  

}

