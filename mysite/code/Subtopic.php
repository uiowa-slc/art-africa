<?php
 
class Subtopic extends Page {
 
  
  private static $db = array(	
  'Description' => 'Text',
  'Tags' => 'Text',
  /*
  'Content2' => 'Text',
  'Content3' => 'Text',
  'Content4' => 'Text',
  'Content5' => 'Text',
  'Content6' => 'Text'*/
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
  
   private static $has_many = array('EssayPages' => 'EssayPage');
  
 
  
  private static $belongs_many_many = array(
  );
  
  private static $plural_name = "Subtopics";
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 	
 		$fields = parent::getCMSFields();
 		
 		$fields->removeFieldFromTab('Root.Main', 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Topic Name'));
		
		$gridFieldConfigEssayPages = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigEssayPages->addComponent(new GridFieldSortableRows('PageNo'));
		$gridFieldConfigEssayPages->getComponentByType('GridFieldAddExistingAutocompleter')->setSearchFields(array('PageNo', 'Content'));
		$gridFieldConfigEssayPages->getComponentByType('GridFieldPaginator')->setItemsPerPage(20);
		$gridfield = new GridField("EssayPages", "Essay Pages", $this->EssayPages(), $gridFieldConfigEssayPages);
		$fields->addFieldToTab('Root.Main', $gridfield);

		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));
		//$fields->addFieldToTab('Root.Main', new HTMLEditorField('Content', 'First content page'));
		

		/*
		$fields->addFieldToTab('Root.Pages', new HTMLEditorField('Content2', 'Second content page'));
		$fields->addFieldToTab('Root.Pages', new HTMLEditorField('Content3', 'Third content page'));
		$fields->addFieldToTab('Root.Pages', new HTMLEditorField('Content4', 'Fourth content page'));
		$fields->addFieldToTab('Root.Pages', new HTMLEditorField('Content5', 'Fifth content page'));
		$fields->addFieldToTab('Root.Pages', new HTMLEditorField('Content6', 'Sixth content page'));*/

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

		$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("VideoPieces", "Video Pieces", $this->VideoPieces(), $gridFieldConfigVideoPieces);
		$fields->addFieldToTab('Root.VideoPieces', $gridfield);

		$gridFieldConfigVideoPiecesViewer = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("VideoPiecesViewer", "View All Video Pieces", VideoPiece::get(), $gridFieldConfigVideoPiecesViewer);
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
	
	public function show (){
	//Displays a data object
	
						
		$otherClass = 'Subtopic';
		
		$objectID = $this->request->param('ID');
		if ($objectID){
		
		    $object = $otherClass::get_by_id($otherClass, $objectID);
		    
		    if(isset($object)){
		       $showTemplate = $otherClass . '_show';
			   return $this->Customise($object)->renderWith(array($showTemplate, 'Page'));
			   
		    }else{
		    }		   
		}
		else {
			return $this->renderWith('Page');
		}
	
	}
	
	

}
