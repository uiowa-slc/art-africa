<?php
 
class Word extends DataObject {
 
  
  private static $db = array(	
	  'Word' => 'Text',
	  'Definition' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $summary_fields = array('Word');
  
  
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', new TextField('Word', 'Word'));
	
		return $fields;		
  }
  

}