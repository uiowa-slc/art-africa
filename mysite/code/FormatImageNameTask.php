<?php
class FormatImageNameTask extends BuildTask {
 
    protected $title = 'Format image names';
 
    protected $description = 'Change image names (not filenames, but the names used to pair images with essays) with long names like 075-97-3936-DHR001 to shorter names like DHR001';
 
    protected $enabled = true;
 
    function run($request) {
        $subject = "000 97 3936 CMS330 G";
		$pattern = '/[A-Z]{3}[0-9]{3}/';
		preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);
		//$imageList = Image::get()->where('"ClassName" = "Image"');
		$imageList = Image::get()->where("\"ClassName\" = 'Image'");
		//Iterate through DataList not on template
		/*
		$imageListIterator = $imageList->getIterator();
		foreach ($imageListIterator as $image){
			print_r($image->Title);
			print_r('<br><br>');
		}
		*/
		print_r($matches);
    }
}


