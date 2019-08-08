<?php
class CollectionRenameTask extends BuildTask {

    protected $title = "Find and replace The Stanley Collection with The Stanley Collection of African Art";
    protected $description = '';
    protected $enabled = true;
    
    
	public function run($request) {

		$coll = ObjectCollection::get()->filter(array('Title' => 'Stanley Collection'))->First();

		if($coll){
			$coll->Title = 'Stanley Collection of African Art';
			$coll->write();
			echo '<p>Renamed Collection to Stanley Collection of African Art</p>';
		}
		

		$images = Image::get();

		echo '<h2>Find/replacing "The Stanley Collection" in $Caption:</h2>';
		
		echo '<h2>Adding UISMA to all Stanley Collection pieces:</h2>';
		echo '<ul>';
		foreach($images as $image){
			$this->findReplaceCaption($image, 'The Stanley Collection', 'The Stanley Collection of African Art');
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