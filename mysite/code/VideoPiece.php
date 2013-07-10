<?php
 
class VideoPiece extends MediaPiece {
 
  
  private static $db = array(	
  'Link' => 'Text',
  'Content' => 'HTMLText'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  

  private static $belongs_many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'Subtopics' => 'Subtopic',
   'ArtPhotos' => 'ArtPhoto',
   'FieldPhotos' => 'FieldPhoto',
   'AudioPieces' => 'AudioPiece',
   'Chapters' => 'Chapter'
  );
  
  private static $plural_name = "Video Pieces";

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		$fields = addCommonFields($fields);
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		$fields->removeFieldFromTab("Root.Main","MediaFile");
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Content', 'Embed the Video Here'));
		
		//$fields->addFieldToTab('Root.Main', new TextField('Link', 'Link'));

		/*$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
		$gridFieldConfigArtPhotosViewer= GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("ArtPhotosViewer", "View All Art Photos", ArtPhoto::get(), $gridFieldConfigArtPhotosViewer);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);


		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigSubtopicsViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("SubtopicsViewer", "View All Subtopics", Subtopic::get(), $gridFieldConfigSubtopicsViewer);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);

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

		$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("AudioPieces", "Audio Pieces", $this->AudioPieces(), $gridFieldConfigAudioPieces);
		$fields->addFieldToTab('Root.AudioPieces', $gridfield);
		
		
		$gridFieldConfigAudioPiecesViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("AudioPiecesViewer", "View All Audio Pieces", AudioPiece::get(), $gridFieldConfigAudioPiecesViewer);
		$fields->addFieldToTab('Root.AudioPieces', $gridfield);
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		
		$gridFieldConfigPeopleViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("PeopleViewer", "View All People", People::get(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);

		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);
		
		$gridFieldConfigEssaysViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("EssaysViewer", "View All Essays", Essay::get(), $gridFieldConfigEssaysViewer);		
		$fields->addFieldToTab('Root.Essays', $gridfield);*/
		
		return $fields;		
  }
  
  
  
    
  

}


