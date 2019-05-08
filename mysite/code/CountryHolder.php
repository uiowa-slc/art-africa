<?php

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
 
class CountryHolder extends Page {
 
  
  private static $db = array(	

  );

  private static $has_one = array(

  );
  
  //private static $allowed_children = array("Country");

  private static $belongs_many_many = array();
  
  //public $holds = "Country";

  public function getCMSFields() {
 		$fields = parent::getCMSFields();
			
		$gridFieldConfigCountry = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", Country::get(), $gridFieldConfigCountry);		
		$fields->addFieldToTab('Root.Main', $gridfield, 'Content');
		$fields->renameField("Content", "Introduction Text");
		

		return $fields;		
  }
  

}


