<?php
 
class Word extends DataObject {
 
  
  public static $db = array(	
	  'Word' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  public static $has_one = array(

  );
  
  
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		return $fields;		
  }
  

}