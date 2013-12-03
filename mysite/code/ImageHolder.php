<?php
 
class ImageHolder extends Page {
 
  
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


class ImageHolder_Controller extends Page_Controller {

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
	
	public static $childPage = 'Image';
	
	public function index(){
		$this->redirect('media/');
	}	
	
	public function getImages(){
		/*$images = new ArrayList();
		$artPhotoImages = Image::get()->filter(array('Type' => 'ArtPhoto'));
		$fieldPhotoImages = Image::get()->filter(array('Type' => 'FieldPhoto'));
		$images->merge($artPhotoImages);
		$images->merge($fieldPhotoImages);*/
		
		//temporary image getter to get only chris roy images for testing purposes
		$images = Image::get();
		$paginatedImageList = new PaginatedList($images, $this->request);
		$paginatedImageList->setPageLength(50);
		$paginatedImageList->sort('RAND()');
		return $paginatedImageList;
	}	
	
	
	
	public function getArtPhotos(){
		$artPhotoImages = Image::get()->filter(array('Type' => 'ArtPhoto'));
		return $artPhotoImages;
	}
	
	public function getFieldPhotos(){
		$fieldPhotoImages = Image::get()->filter(array('Type' => 'FieldPhoto'));
		return $fieldPhotoImages;
	}
	
	
	  public function ReturnLink(){

	  	
	  	
	  }	 
		
	
	
}
