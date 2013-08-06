<?php
class FormatImageNameTask extends BuildTask {
 
    protected $title = 'Format image names';
 
    protected $description = 'Change image names (not filenames, but the names used to pair images with essays) with long names like 075-97-3936-DHR001 to shorter names like DHR001';
 
    protected $enabled = true;
 
    function run($request) {
        /*
        
        Here is some regex testing code
        
        
        $subject = "000 97 3936 CMS330 G";
        print_r("subject = ");
        print_r($subject);
        print_r("<br><br>");
		$pattern = '/[A-Z]{3}[0-9]{3}/';
		preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);*/
		
		$imageList = Image::get()->where("\"ClassName\" = 'Image'");
		
		$imageListIterator = $imageList->getIterator();
		$iter = 0;
		foreach ($imageListIterator as $image){
			$imageTitle = $image->Title;
			//Match IDs like CMS380, AFR101, whatever
			$pattern = '/[A-Z]{3}[0-9]{3}/';
			preg_match($pattern, $imageTitle, $matches, PREG_OFFSET_CAPTURE);
			if (isset($matches[0][0])){
				$match = $matches[0][0];
				
				$pattern = '/[" "][A-Z]/';

				//Clearly I don't know how to do regex, because I use this to handle cases with a space and a letter after instead of combining it into the original expression
				$imageTitleSubstr = substr($imageTitle, -2);
				preg_match($pattern, $imageTitleSubstr, $substrMatches, PREG_OFFSET_CAPTURE);
				if (isset($substrMatches[0][0])){
					$match = $match . $substrMatches[0][0];
				}

				print_r($match);
			}
			else {
				print_r($imageTitle);
			}
			
			print_r('<br><br>');
			$iter++;
			/*
			Limit iterations for testing */
			
			if ($iter > 500){
				break;
			}
			
		}
		
		print_r($matches);
    }
}


