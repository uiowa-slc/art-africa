<?php

use SilverStripe\Dev\BuildTask;
class LowercaseObjectTypeTask extends BuildTask {

    protected $title = "Make all object types and mediums lowercase";
    protected $description = '';
    protected $enabled = false;
    
    
	function run($request) {

		$types = ObjectType::get();
		$mediums = ObjectMedium::get();

		echo '<h2>Converting all Object Types to lowercase</h2>';
		echo '<ul>';
		foreach($types as $type){
			$typeTitle = $type->Title;
			$typeLower = strtolower($typeTitle);
			
			echo '<li>Converting type <strong>'.$typeTitle.'</strong> to <strong>'.$typeLower.'</strong></li>';

			$type->Title = $typeLower;
			$type->write();
		}
		echo '</ul>';

		echo '<h2>Converting all Object Mediums to lowercase</h2>';
		echo '<ul>';
		foreach($mediums as $medium){
			$mediumTitle = $medium->Title;
			$mediumLower = strtolower($mediumTitle);
			
			echo '<li>Converting medium <strong>'.$mediumTitle.'</strong> to <strong>'.$mediumLower.'</strong></li>';

			$medium->Title = $mediumLower;
			$medium->write();
		}
		echo '</ul>';
	}
 

}