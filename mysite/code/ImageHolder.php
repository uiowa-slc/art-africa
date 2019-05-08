<?php

use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\PaginatedList;
 
class ImageHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","Content");
		$content = new HTMLEditorField("Content", "Content -- Use this field to edit the introduction to photos that shows up on the front-end of the site.  Use Art Photos and Field Photos to edit the photos themselves.");
		$fields->addFieldToTab("Root.Main", $content);
		return $fields;		
  }

}

