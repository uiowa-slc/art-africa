<?php
 
class Subtopic extends Page {
 
  
  private static $db = array(	
  'Name' => 'Varchar',
  'Description' => 'Text',
  'Tags' => 'Text'
  );

  
   private static $many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'AudioPieces' => 'AudioPiece',
   'VideoPieces' => 'VideoPiece',
   'ArtPhotos' => 'ArtPhoto',
   'FieldPhotos' => 'FieldPhoto'

  
  );
  
 
  
  private static $belongs_many_many = array(
  );
  
  private static $plural_name = "Subtopics";
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 	
 		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Topic Name (make the same as page name)'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Topic Description'));
		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
		
		$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigArtPhotos->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("ArtPhotos", "Art Photos", $this->ArtPhotos(), $gridFieldConfigArtPhotos);
		$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		
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
		
		$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigVideoPieces->addComponent(new GridFieldManyRelationHandler());
		$gridfield = new GridField("VideoPieces", "Video Pieces", $this->VideoPieces(), $gridFieldConfigVideoPieces);
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);

		return $fields;		

  }
  
    
}


class Subtopic_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array ();
	

}
