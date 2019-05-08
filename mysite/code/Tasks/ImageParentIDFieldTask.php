<?php

use SilverStripe\Assets\Image;
use SilverStripe\Dev\BuildTask;
class ImageParentIDFieldTask extends BuildTask {
 
    protected $title = 'Populate Image ParentID field';
 
    protected $description = '';
 
    protected $enabled = false;
 
    function run($request) {

		$images = Image::get();
		foreach($images as $image){
			echo '<li> writing image '.$image->ID.'</li>';
			$image->write();
		}
		
    }
}


