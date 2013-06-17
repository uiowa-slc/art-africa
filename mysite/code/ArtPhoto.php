<?php
 
class ArtPhoto extends Photo {
 
  
  private static $db = array(	
  'ArtID' => 'Text',
  'TraditionalName' => 'Text',
  'Material' => 'Text',
  'Size' => 'Text',
  'Function' => 'Text',
  'Style' => 'Text',
  'Substyle' => 'Text',
  'Collection' => 'Text',
  'Source' => 'Text'

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $many_many = array(
  'Essays' => 'Essay',
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  'FieldPhotos' => 'FieldPhoto'
  );
  
  private static $belongs_many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'Subtopics' => 'Subtopic',
   'AudioPieces' => 'AudioPiece',
   'VideoPieces' => 'VideoPiece'

  
  );
  
  private static $plural_name = "Art Photos";
  
   
  
 // public static $hide_ancestor = 'Photo';
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		
		$fields->addFieldToTab('Root.Main', new TextField('ArtID', 'Art ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('TraditionalName', 'Traditional Name'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Description'));
 		$fields->addFieldToTab('Root.Main', new TextField('TraditionalName', 'Traditional Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('Material', 'Material'));
 		$fields->addFieldToTab('Root.Main', new TextField('Size', 'Size'));
 		$fields->addFieldToTab('Root.Main', new TextField('Function', 'Function'));
 		$fields->addFieldToTab('Root.Main', new TextField('Style', 'Style'));
 		$fields->addFieldToTab('Root.Main', new TextField('Substyle', 'Substyle'));
 		$fields->addFieldToTab('Root.Main', new TextField('Collection', 'Collection'));
 		$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));
		
		$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigAudioPieces->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("AudioPieces", "Audio Pieces", $this->AudioPieces(), $gridFieldConfigAudioPieces);
		$fields->addFieldToTab('Root.AudioPieces', $gridfield);
		
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
  /*
  public function getCMSValidator(){
	  return new RequiredFields('CreditLine');
  }
  */
  
  	public function onBeforeWrite(){
  		//print_r($this->CreditLine);
		if ($this->Name == 'Female Figure With Child'){
			return;
		}
		
		parent::onBeforeWrite();
	}
	
  
  
  
  

}

