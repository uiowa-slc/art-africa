<?php

use SilverStripe\Dev\BuildTask;
use SilverStripe\Assets\Folder;

class RenameFoldersWithDots extends BuildTask {

    protected $title = "Rename folders with dots in their folder names";
    protected $description = 'Fixes folders for SilverStripe 4';
    protected $enabled = true;
    
    
	function run($request) {
		$folders = Folder::get()->filter(array('Name:PartialMatch' => '.' ));

        foreach($folders as $folder){
            echo '<li>Renaming "'.$folder->Title.'" </li>';
            $folderTitle = str_replace(".", "", $folder->Title);
            $folder->renameFile($folderTitle);
            $folder->write();

        }
	}
 

}