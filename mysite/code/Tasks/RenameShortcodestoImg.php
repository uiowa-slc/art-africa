<?php

use SilverStripe\Dev\BuildTask;
use SilverStripe\Assets\Folder;

class RenameShortcodestoImg extends BuildTask {

    protected $title = "Rename existing [Image] shortcodes to [Img] to allow editing in tinyMCE";
    protected $description = '';
    protected $enabled = true;
    
    
	function run($request) {
        $essayPages = EssayPage::get()->filter(array('Content:PartialMatch' => '[Image ' ));

        foreach($essayPages as $essayPage){

            $essayPage->Content = str_replace("[Image", "[Img", $essayPage->Content);
            $essayPage->write();
        }
	}
 

}