<?php

use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;
 
class MediaHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  //private static $allowed_children = array('AudioPiece', 'VideoPiece');
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  		
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab('Root.Main','Content');
		//$fields->addFieldToTab('Root.Main')
		$content = new HTMLEditorField('Content', 'Content -- Use this field to edit the introduction to the audio and video that shows up on the front-end of the site.  Use the Audio and Video pages to edit the photos themselves.');
		$fields->addFieldToTab('Root.Main', $content);
		return $fields;	
  }
  

}

