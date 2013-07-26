<?php
 
class Subtopic extends Page {
 
  
  private static $db = array(	
  'Description' => 'Text',
  'Tags' => 'Text',
  );

  private static $has_one = array(
  	'CoverImage' => 'Image'
  );
    
   private static $many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'AudioPieces' => 'AudioPiece',
   'VideoPieces' => 'VideoPiece',
   'ArtPhotos' => 'ArtPhoto',
   'FieldPhotos' => 'FieldPhoto',
   'Images' => 'Image'

  
  );
  
   private static $has_many = array('EssayPages' => 'EssayPage');
  
 
  
  private static $belongs_many_many = array(
  );
  
  private static $plural_name = "Subtopics";
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields = $this->addCommonFields($fields);

 		
 		$fields->removeFieldFromTab('Root.Main', 'Content');
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Topic Name'));
		$fields->addFieldToTab('Root.Main', new UploadField('CoverImage', 'Cover Image'));
		$gridFieldConfigEssayPages = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigEssayPages->addComponent(new GridFieldSortableRows('PageNo'));
		$gridFieldConfigEssayPages->getComponentByType('GridFieldAddExistingAutocompleter')->setSearchFields(array('PageNo', 'Content'));
		$gridFieldConfigEssayPages->getComponentByType('GridFieldPaginator')->setItemsPerPage(20);
		$gridfield = new GridField("EssayPages", "Essay Pages", $this->EssayPages(), $gridFieldConfigEssayPages);
		$fields->addFieldToTab('Root.Main', $gridfield);

		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));

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
	
	public function getNextSubtopic($title, $type){
		$currentSubtopic = Subtopic::get()->filter(array('Title' => $title))->First();
		$chapter = $currentSubtopic->getParent();
		$chapterSubtopics = $chapter->Children();
		$check = false;
		foreach($chapterSubtopics as $subtopic){
			if ($check == true){
				$returnedSubtopic = $subtopic;
								
				$check = false;
			}
			if ($subtopic->Title == $currentSubtopic->Title){
				$check = true;
							}	
		}
		
		if (!isset($returnedSubtopic)){
			$returnedSubtopic = $chapterSubtopics->First();
		}
		if ($type=='Link'){
			return $returnedSubtopic->Link();
		}
		elseif ($type=='Title') {
			return $returnedSubtopic->Title;
		}
	}
	
	

}
