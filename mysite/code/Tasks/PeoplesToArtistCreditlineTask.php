<?php
class PeoplesToArtistCreditlineTask extends BuildTask {

    protected $title = "Find and replace 'peoples' to 'artist' in caption";
    protected $description = '';
    protected $enabled = true;
    
    
	public function run($request) {


		$images = Image::get();

		echo '<h2>Find/replacing "peoples" in $Caption:</h2>';
		echo '<ul>';
		foreach($images as $image){
			$this->findReplaceCaption($image, 'peoples', 'artist');
		}
		echo '</ul>';


		echo '<p>Done...?</p>';

		

	}


	private function findReplaceCaption($image, $find, $replace){
			$caption = $image->obj('Caption')->RAW();
		
			// if(strpos($caption, $find) !== false){

	

			if(preg_match("/peoples(?!([^<]+)?>)/i", $caption)){

				echo '<li>Match found and replaced in... <strong><a href="'.$image->ShowLink().'">'.$image->Title.'</a></strong></li>';
				$captionReplaced = preg_replace("/peoples(?!([^<]+)?>)/i",$replace,$caption);
				
				$image->Caption = $captionReplaced;
				$image->write();
			}
	}
 

}