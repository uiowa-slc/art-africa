<?php

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Assets\Image;
 
class EssayHolder extends Page {
  
  private static $db = array(	

  );
  private static $has_one = array(

  );
  private static $belongs_many_many = array();
  //private static $allowed_children = array("Essay");
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		$fields->removeFieldFromTab("Root.Main","Content");	
		$gridFieldConfigEssays = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("Essay", "Essays", Essay::get()->sort('Title'), $gridFieldConfigEssays);		
		$fields->addFieldToTab('Root.Main', $gridfield);
		$fields->addFieldToTab('Root.Main', new HTMLEditorField("Content","Introduction Text"));

		return $fields;		
  }
}

