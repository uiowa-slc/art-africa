<?php
 
class Chapter extends Page {
 
  
  private static $db = array(	
  'Description' => 'Text',
  'Author' => 'Varchar(255)',
  'University' => 'Varchar(255)',
  'Tags' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  	'CoverImage' => 'Image'
  );
  

   private static $default_child = array(
    "Subtopic"
   );
   
  private static $many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'AudioPieces' => 'AudioPiece',
   'VideoPieces' => 'VideoPiece',
   'Images' => 'Image'

  
  );
  
  private static $has_many = array('EssayPages' => 'EssayPage');
  
  private static $belongs_many_many = array(
  
  );
  


  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		$fields = $this->addCommonFields($fields);
		$fields->removeFieldFromTab('Root.Main', 'Content');
		
		$gridFieldConfigEssayPages = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigEssayPages->addComponent(new GridFieldSortableRows('PageNo'));
		$gridFieldConfigEssayPages->getComponentByType('GridFieldAddExistingAutocompleter')->setSearchFields(array('PageNo', 'Content'));
		$gridFieldConfigEssayPages->getComponentByType('GridFieldPaginator')->setItemsPerPage(20);
		
		$gridfield = new GridField("EssayPages", "Introduction Essay Pages", $this->EssayPages(), $gridFieldConfigEssayPages);
		$fields->addFieldToTab('Root.Main', $gridfield);
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Chapter Name'), 'URLSegment');
		$fields->addFieldToTab('Root.Main', new UploadField('CoverImage', 'Cover Image'));
		//$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Topic Description'));
		$fields->addFieldToTab('Root.Main', new TextField('Author', 'Author'));
		$fields->addFieldToTab('Root.Main', new TextField('University', 'University'));

		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));


		
	
		
		return $fields;		
  }

  public function CoverPhoto(){
  	$image = $this->Images()->sort('RAND()')->first();
  	return $image;
  	echo "hello";

  }
  
  
  

}


class Chapter_Controller extends Page_Controller {

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
	
	public function getNextChapter(){
	
		$chapterHolder = $this->getParent();
		$chapters = $chapterHolder->Children();
				
		$check = false; //true when match for chapter found
				
			foreach($chapters as $loopChapter){
			
				if ($check == true){
					$returnedItem = $loopChapter;
									
					$check = false;
				}
				if ($loopChapter->Title == $this->Title){
					$check = true;
				}	
				
			}		
		
		
		if (!isset($returnedItem)){
			//We're in the last chapter, so return the first chapter's link or title
			$returnedItem = Chapter::get()->First();
		}
	    
	    if (isset($returnedItem)){
			return $returnedItem;
		}
	}
	
	public function hasChildren(){
		$children = $this->Children()->First(); //just $this->Children returns an empty ArrayList that evaluates to true

		if ($children){
			return true;
		}
		else {
			return false;
		}
	}

	public function nextPageInTree() {

		$page = $this->Children()->First();
		return $page;
	}
}
