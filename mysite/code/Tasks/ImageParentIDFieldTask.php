<?php
class ImageParentIDFieldTask extends BuildTask {
 
    protected $title = 'Populate Image ParentID field';
 
    protected $description = '';
 
    protected $enabled = true;
 
    function run($request) {

		$images = Image::get();
		foreach($images as $image){
			echo '<li> writing image '.$image->ID.'</li>';
			$image->write();
		}
		
    }
}


