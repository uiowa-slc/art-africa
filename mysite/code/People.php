<?php
 
class People extends Page {
 
  
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
  'MediaPieces' => 'MediaPiece',
  'Photos' => 'Photo',
  
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
		
		$gridFieldConfigMediaPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("MediaPieces", "MediaPieces", $this->MediaPieces(), $gridFieldConfigMediaPieces);
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		$gridFieldConfigPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Photos", "Photos", $this->Photos(), $gridFieldConfigPhotos);
		$fields->addFieldToTab('Root.Photos', $gridfield);
		
		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);

		
		return $fields;		
  }
  
  
  

}


class People_Controller extends Page_Controller {

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
