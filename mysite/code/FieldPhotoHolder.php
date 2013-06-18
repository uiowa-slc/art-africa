<?php
 
class FieldPhotoHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
			
		$gridFieldConfigFieldPhoto = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("FieldPhoto", "FieldPhotos", FieldPhoto::get(), $gridFieldConfigFieldPhoto);		
		$fields->addFieldToTab('Root.FieldPhotos', $gridfield);
		
		return $fields;		
  }
  
  
  

}


class FieldPhotoHolder_Controller extends Page_Controller {

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
	private static $allowed_actions = array ('show', 'getFieldPhotos');
	
	public function show (){
	//Displays a data object
	
						
		$class = 'FieldPhoto';
		
		$objectID = $this->request->param('ID');
		
		
		if ($objectID){
		
		    $object = $class::get_by_id($class, $objectID);
		    
		    if(isset($object)){
		       $showTemplate = $class . 'Holder_show';
			   return $this->Customise($object)->renderWith(array($showTemplate, 'Page'));
			   
		    }else{
		    }		   
		}
		else {
			return $this->renderWith('Page');
		}
	
	}
	
	public function testFunction(){
		$returnString = "HI";
		return $returnString;
	}
	

	
	
	
	
	
	
	 
	
	
	
}
