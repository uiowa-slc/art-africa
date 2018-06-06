<?php
class MuseumRenameTask extends BuildTask {

    protected $title = "Find and replace UIMA and replace with UISMA in caption";
    protected $description = 'Uses a few possible variations also fixes empty museum credits.';
    protected $enabled = true;
    
    
	public function run($request) {

		$museum = ObjectMuseum::get()->filter(array('Title' => 'University of Iowa Museum of Art'))->First();

		if($museum){
			$museum->Title = 'University of Iowa Stanley Museum of Art';
			$museum->write();
			echo '<p>Renamed Museum category to University of Iowa Stanley Museum of Art</p>';
		}
		

		$images = Image::get();

		echo '<h2>Find/replacing "The University of Iowa Museum of Art" in $Caption:</h2>';
		echo '<ul>';
		foreach($images as $image){
			$this->findReplaceCaption($image, 'The University of Iowa Museum of Art', 'University of Iowa Stanley Museum of Art');
		}
		echo '</ul>';

		echo '<h2>Find/replacing "University of Iowa Museum of Art" in $Caption:</h2>';
		echo '<ul>';
		foreach($images as $image){
			$this->findReplaceCaption($image, 'University of Iowa Museum of Art', 'University of Iowa Stanley Museum of Art');
		}
		echo '</ul>';

		echo '<h2>Adding UISMA to all Simon-Collection pieces:</h2>';
		echo '<ul>';

		foreach($images as $image){
			$this->findReplaceCaption($image, '<p>J. Richard Simon Collection', '<p>University of Iowa Stanley Museum of Art, J. Richard Simon Collection');
		}
		echo '</ul>';

		echo '<h2>Adding UISMA to all Stanley Collection pieces:</h2>';
		echo '<ul>';
		foreach($images as $image){
			$this->findReplaceCaption($image, '<p>The Stanley Collection', '<p>University of Iowa Stanley Museum of Art, The Stanley Collection');
		}
		echo '</ul>';
		echo '<p>Done...?</p>';
	}


	private function findReplaceCaption($image, $find, $replace){
			$caption = $image->obj('Caption')->RAW();
		
			if(strpos($caption, $find) !== false){
				echo '<li>Match found and replaced in... <strong><a href="'.$image->ShowLink().'">'.$image->Title.'</a></strong></li>';
				$captionReplaced = str_replace($find,$replace, $caption);
				
				$image->Caption = $captionReplaced;
				$image->write();
			}
	}
 

}