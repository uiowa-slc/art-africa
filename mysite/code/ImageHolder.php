<?php
 
class ImageHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","Content");
		$content = new HTMLEditorField("Content", "Content -- Use this field to edit the introduction to photos that shows up on the front-end of the site.  Use Art Photos and Field Photos to edit the photos themselves.");
		$fields->addFieldToTab("Root.Main", $content);
		return $fields;		
  }

}


class ImageHolder_Controller extends Page_Controller {


	private static $allowed_actions = array ('show', 'getArtPhotos', 'getFieldPhotos');
	
	public static $childPage = 'Image';
	
	public function index(){
		$this->redirect('media/');
	}	
	
	public function getImages(){
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
	

}
