<?php
class MuseumRenameTask extends BuildTask {

    protected $title = "Find and replace UIMA and replace with UISMA in caption";
    protected $description = 'Uses a few possible variations also fixes empty museum credits.';
    protected $enabled = true;
    
    
	public function run($request) {

		$images = Image::get();

		echo '<h2>Find/replacing "The University of Iowa Museum of Art" in $Caption:</h2>';
		echo '<ul>';
		foreach($images as $image){
			$caption = $image->obj('Caption')->RAW();
			//print_r($image->obj('Caption')->RAW());
			if(strpos($caption, 'The University of Iowa Museum of Art') !== false){
				echo '<li>Match found and replaced in... <strong>'.$image->Title.'</strong></li>';
				$captionReplaced = str_replace('The University of Iowa Museum of Art','The University of Iowa Stanley Museum of Art', $caption);
				
				$image->Caption = $captionReplaced;
				$image->write();
			}

		}
		echo '</ul>';

		echo '<h2>Find/replacing "University of Iowa Museum of Art" in $Caption:</h2>';
		echo '<ul>';
		foreach($images as $image){
			$caption = $image->obj('Caption')->RAW();
			//print_r($image->obj('Caption')->RAW());
			if(strpos($caption, 'University of Iowa Museum of Art') !== false){
				echo '<li>Match found and replaced in... <strong>'.$image->Title.'</strong></li>';
				$captionReplaced = str_replace('University of Iowa Museum of Art','The University of Iowa Stanley Museum of Art', $caption);
				
				$image->Caption = $captionReplaced;
				$image->write();
			}

		}
		echo '</ul>';

		echo '<h2>Adding UISMA to all Simon-Collection pieces:</h2>';
		echo '<ul>';

		foreach($images as $image){
			$caption = $image->obj('Caption')->RAW();
			//print_r($image->obj('Caption')->RAW());
			if(strpos($caption, '<p>J. Richard Simon Collection') !== false){
				echo '<li>Match found and replaced in... <strong>'.$image->Title.'</strong></li>';
				$captionReplaced = str_replace('<p>J. Richard Simon Collection','<p>The University of Iowa Stanley Museum of Art, J. Richard Simon Collection', $caption);
				
				$image->Caption = $captionReplaced;
				$image->write();
			}

		}
		echo '</ul>';

		echo '<h2>Adding UISMA to all Stanley Collection pieces:</h2>';
		echo '<ul>';

		foreach($images as $image){
			$caption = $image->obj('Caption')->RAW();
			//print_r($image->obj('Caption')->RAW());
			if(strpos($caption, '<p>The Stanley Collection') !== false){
				echo '<li>Match found and replaced in... <strong>'.$image->Title.'</strong></li>';
				$captionReplaced = str_replace('<p>The Stanley Collection','<p>The University of Iowa Stanley Museum of Art, The Stanley Collection', $caption);
				
				$image->Caption = $captionReplaced;
				$image->write();
			}

		}
		echo '</ul>';
		echo '<p>Done...?</p>';
	}
 

}