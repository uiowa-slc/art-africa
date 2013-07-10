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
   'FieldPhotos' => 'FieldPhoto',
   'Chapters' => 'Chapter'
  );
  
  private static $plural_name = "Audio Pieces";

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		
		

		/*$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
		$gridFieldConfigArtPhotosViewer= GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("ArtPhotosViewer", "View All Art Photos", ArtPhoto::get(), $gridFieldConfigArtPhotosViewer);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);

		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
		$gridFieldConfigCountriesViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("CountriesViewer", "View All Countries", Country::get(), $gridFieldConfigCountriesViewer);	
		$fields->addFieldToTab('Root.Countries', $gridfield);

		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);
		
		$gridFieldConfigEssaysViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("EssaysViewer", "View All Essays", Essay::get(), $gridFieldConfigEssaysViewer);		
		$fields->addFieldToTab('Root.Essays', $gridfield);

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
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);*/




		return $fields;		
			
	
		

		
		return $fields;		
  }
  
  
  

}

