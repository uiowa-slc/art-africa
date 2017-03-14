<?php
class LowercaseObjectTypeTask extends BuildTask {

    protected $title = "Make all object types lowercase";
    protected $description = '';
    protected $enabled = true;
    
    
	function run($request) {

		$types = ObjectType::get();
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
	}
 

}