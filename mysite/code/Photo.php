<?php
 
class Photo extends Page {
 
  
  private static $db = array(
  'Description' => 'Text',
  'TraditionalName' => 'Text',
  'Material' => 'Text',
  'Size' => 'Text',
  'Function' => 'Text',
  'Style' => 'Text',
  'Substyle' => 'Text',
  'Collection' => 'Text',
  'Source' => 'Text',	
  'Tags' => 'Text'

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $many_many = array(
  'Essays' => 'Essay',
  'MediaPieces' => 'MediaPiece'
  );

  
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Countries' => 'Country',
  'People' => 'People'
  );
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Description', 'Description'));
 		$fields->addFieldToTab('Root.Main', new TextField('TraditionalName', 'Traditional Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('Material', 'Material'));
 		$fields->addFieldToTab('Root.Main', new TextField('Size', 'Size'));
 		$fields->addFieldToTab('Root.Main', new TextField('Function', 'Function'));
 		$fields->addFieldToTab('Root.Main', new TextField('Style', 'Style'));
 		$fields->addFieldToTab('Root.Main', new TextField('Substyle', 'Substyle'));
 		$fields->addFieldToTab('Root.Main', new TextField('Collection', 'Collection'));
 		$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));
 		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));

 		$gridFieldConfigSubtopics = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Subtopics", "Subtopics", $this->Subtopics(), $gridFieldConfigSubtopics);					
		$fields->addFieldToTab('Root.Subtopics', $gridfield);
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", $this->Countries(), $gridFieldConfigCountries);	
		$fields->addFieldToTab('Root.Countries', $gridfield);
				
		$gridFieldConfigMediaPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("MediaPieces", "MediaPieces", $this->MediaPieces(), $gridFieldConfigMediaPieces);	
		$fields->addFieldToTab('Root.MediaPieces', $gridfield);
		
		$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("People", "People", $this->People(), $gridFieldConfigPeople);
		$fields->addFieldToTab('Root.People', $gridfield);
		
		$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Essays", "Essays", $this->Essays(), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Essays', $gridfield);

		return $fields;		
  }
  
    public function onBeforeWrite(){
    	$publishPage = $this->IsPublished();
  	
    	if (isset($publishPage)){
			if (!$publishPage){
			  $photoParent = PhotoHolder::get()->First();
			  $this->setParent($photoParent);
			}
		}
		parent::onBeforeWrite();
	}
  
  

}


class Photo_Controller extends Page_Controller {

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
