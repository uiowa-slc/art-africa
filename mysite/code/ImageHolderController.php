<?php

use SilverStripe\Assets\Image;
use SilverStripe\ORM\PaginatedList;
class ImageHolderController extends PageController {


	private static $allowed_actions = array ('show', 'getArtPhotos', 'getFieldPhotos');
	
	public static $childPage = Image::class;
	
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
