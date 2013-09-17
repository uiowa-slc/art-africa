<?php
 
class EssayHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $belongs_many_many = array();
  
  private static $allowed_children = array("Essay");
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		$fields->removeFieldFromTab("Root.Main","Content");	
		$gridFieldConfigEssays = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("Essay", "Essays", Essay::get()->sort('Title'), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Main', $gridfield);
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("Content","Introduction Text"));

		
		
		return $fields;		
  }
  

}


class EssayHolder_Controller extends Page_Controller {

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
	private static $allowed_actions = array ('show');
	
	public static $childPage = 'Essay';
	
	
	
	
	public function essaysByAuthor(){
		$essays = Essay::get();
		$essays->sort('Author', 'DESC');
		return $essays;
	}
	
	//Called by show template
	public function getPaginatedPages(){
		 $ID = $this->request->param('ID');
		 //$object = DataObject::get_by_id('Essay', $ID);
		 
		 $object = Essay::get()->byID($ID);
		 $relation = $object->EssayPages();
		 $list = new PaginatedList($relation, $this->request);
		 $list->setPageLength(1);
		 return $list;
	}
	
	public function getEssayImages(){
		 $ID = $this->request->param('ID');
		 $object = Essay::get()->byID($ID);
		 $relation = $object->EssayPages();
		 
		 $essayImages = new ArrayList();
		 
		 foreach($relation as $page){
			 $content = $page->Content;
			 $pattern = '/[A-Z]{3}[0-9]{1,3}[" "]?[A-Z]?[0-9]?/';
			 preg_match($pattern, $content, $matches, PREG_OFFSET_CAPTURE);
			 foreach ($matches as $match){	 
			 	$newImage = Image::get()->filter(array('Title' => $match))->first();
			 	
			 	if ($newImage){
				 	$essayImages->add($newImage);
				 	
			 	}
			 }
		 }
		 
		 //print_r($essayImages);
		 return $essayImages;
	}
	

	
	public function getEssays () {
	
		$essays = Essay::get()->sort('Title');
		return $essays;
	}
}
