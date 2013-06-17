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
  'Picture' => 'Image'
  
  );
  
  private static $searchable_fields = array(
  'Name'
  );
  
  private static $many_many = array(
  'People' => 'People',
  'Essays' => 'Essay',
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  'ArtPhotos' => 'ArtPhoto',
  'FieldPhotos' => 'FieldPhoto'
  );
  
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic'
  
  );
  
  private static $plural_name = "Countries";
  

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
 		$fields->addFieldToTab('Root.Main', new TextAreaField('PrecolonialHistory', 'Precolonial History'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('PostcolonialHistory', 'Postcolonial Language'));
 		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
 		$fields->addFieldToTab('Root.Main', new UploadField('Picture', 'Picture'));
 		
 		$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
 		$gridFieldConfigAudioPieces->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("AudioPieces", "Audio Pieces", $this->AudioPieces(), $gridFieldConfigAudioPieces);
		$fields->addFieldToTab('Root.AudioPieces', $gridfield);


		$gridFieldConfigAudioPiecesViewer= GridFieldConfig_RecordEditor::create(); 
		$gridfieldViewer = new GridField("AudioPiecesViewer", "View All Audio Pieces", AudioPiece::get(), $gridFieldConfigAudioPiecesViewer);
		$fields->addFieldToTab('Root.AudioPieces', $gridfieldViewer);

		$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);

		$gridFieldConfigArtPhotosViewer= GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("ArtPhotosViewer", "View All Art Photos", ArtPhoto::get(), $gridFieldConfigArtPhotosViewer);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);

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
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);

		return $fields;	
  }
  
 
  /*
  public function onBeforeWrite(){
	  
	  $allRelationships = new ArrayList();
	  
	  
	  foreach(Country::$many_many as $relationshipKey => $relationshipValue){
		  $allRelationships->merge($this->$relationshipKey());
	  }
	  
	  foreach(Country::$belongs_many_many as $relationshipKey => $relationshipValue){
	  	  $allRelationships->merge($this->$relationshipKey());
	  }
	  
	  
	  $allRelationships->merge($this->AudioPieces());
	  $allRelationships->merge($this->ArtPhotos());
	  $allRelationships->merge($this->Essays());
	  $allRelationships->merge($this->FieldPhotos());
	  $allRelationships->merge($this->People());
	  $allRelationships->merge($this->Subtopics());
	  $allRelationships->merge($this->VideoPieces());  
	  
	  $newTags = $this->Tags;
	
	  $lastCharacterOfTags = substr($newTags, -1);
	  
	  $newTagsArray = explode(",", $newTags);
	  $newTagsLength = strlen($newTags);
	  $newTagsCount = count($newTagsArray);
	  $allRelationshipsCount = count($allRelationshipsCount);
	  $iter = 0;
	  $changeMade = false;
	  
	  foreach($allRelationships as $relatedItem){
	    $addTag = true;
	  	foreach ($newTagsArray as $tag){
	  	    $stripTag = trim($tag);
		  	if ($relatedItem->Name == $stripTag){
			  	$addTag = false;
			  			  
			 }
		}
		print_r("NEW TAGS COUNT " . $newTagsCount);
		print_r($newTagsCount);
		
		
		if ($addTag == true){
			$iter++;
		    if (($iter == 1) && ($newTagsLength > 0))	{
			    $newTags .= ', ';
		    }
			if ($iter == $allRelationshipsCount) {
				$newTags = $newTags . $relatedItem->Name;
			}					
			else {
				$newTags = $newTags . $relatedItem->Name . ', ';
			}
			$changeMade = true;
		}		
		
	  }
	if ($changeMade){  
	  	$newTagsLength = strlen($newTagsLength);
		$newTags = substr($newTags, 0, $newTagsLength - 2);
	}
	
	$this->Tags = $newTags;
	$this->PrecolonialHistory = 'New Tags Array Length ' . $newTagsLength;
	$this->PostcolonialHistory = 'New Tags Change Made '  . ($changeMade == true) ? 'true' : 'false';
	
	

	parent::onBeforeWrite();
  }
  */
  
  
}

