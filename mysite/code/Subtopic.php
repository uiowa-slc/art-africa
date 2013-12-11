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

	public function nextPageInTree() {

		$page = Page::get()->filter(array (
			'ParentID' => $this->ParentID,
			'Sort:GreaterThan' => $this->Sort
			))->First();

		if(!$page){

			$parentPage = $this->getParent();

			$page = Page::get()->filter(array (
			'ParentID' => $parentPage->ParentID,
			'Sort:GreaterThan' => $parentPage->Sort
			))->First(); 
		}

		return $page;
	}
	
	public function getNextSubtopic($title, $type='Subtopic'){
	//Title is used to get the next subtopic, returnType returns either a Link or the Title 
		$currentSubtopic = $type::get()->filter(array('Title' => $title))->First();
		$chapter = $currentSubtopic->getParent();
		$chapterSubtopics = $chapter->Children();
		
		$check = false; //true when match for subtopic found
		
		foreach($chapterSubtopics as $subtopic){
			if ($check == true){
				$returnedItem = $subtopic;
								
				$check = false;
			}
			if ($subtopic->Title == $currentSubtopic->Title){
				$check = true;
			}	
		}
	
		
		if (!isset($returnedItem)){
		//If returned subtopic isn't set, it's the last subtopic in a chapter -- meaning we want the next link to point to the next chapter
			$chapterHolder = $chapter->getParent();
			$chapters = $chapterHolder->Children();
			
			$check = false; //true when match for chapter found
			
			foreach($chapters as $loopChapter){
			
				if ($check == true){
					$returnedItem = $loopChapter;
									
					$check = false;
				}
				if ($loopChapter->Title == $chapter->Title){
					$check = true;
				}	
			}
			
			if (!isset($returnedItem)){
				//We're in the last chapter, so return the first chapter's link or title
				$returnedItem = Chapter::get()->First();
			}
			/*
			if ($returnType=='Link'){
				return $returnedChapter->Link();
			}
			elseif ($returnType=='Title') {
				return $returnedChapter->Title;
			}*/
		    
				
		}
		/*
		if ($returnType=='Link'){
			return $returnedSubtopic->Link();
		}
		elseif ($returnType=='Title') {
			return $returnedSubtopic->Title;
		}*/
		
		
		return $returnedItem;
	}
	
	

}
