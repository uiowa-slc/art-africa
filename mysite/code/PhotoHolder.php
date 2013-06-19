<?php
 
class PhotoHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $allowed_children = array("ArtPhoto", "FieldPhoto");
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","Content");
		//$fields->addFieldToTab("Root.Main")
		$content = new HTMLEditorField("Content", "Content -- Use this field to edit the introduction to photos that shows up on the front-end of the site.  Use Art Photos and Field Photos to edit the photos themselves.");
		$fields->addFieldToTab("Root.Main", $content);
		return $fields;		
  }
  
  
  

}


class PhotoHolder_Controller extends Page_Controller {

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
	private static $allowed_actions = array ('show', 'getArtPhotos', 'getFieldPhotos');
	
	
	public function show (){
	//Displays a data object
	
						
		
		
		$objectID = $this->request->param('ID');
		

		
		
		
		if ($objectID){
		
			
		
		    $object = $otherClass::get_by_id($otherClass, $objectID);
		    
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
	
	public function getArtPhotos(){
		$artPhotos = ArtPhoto::get();
		return $artPhotos;
	}
	
	public function getFieldPhotos(){
		$fieldPhotos = FieldPhoto::get();
		return $fieldPhotos;
	}
	
	
	 
	
	
	
}
