<?php
 
class HomepagePic extends DataObject {
 
  
  private static $db = array(
  'Link' => 'Text',
  'CreditLine' = 'Text',
    );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  'HomepagePic' => 'Image',
  'HomePage' => 'HomePage'
  );
  
  
  private static $many_many = array(
  
  );
  private static $belongs_many_many = array(
 
  
  );
  
  
  
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		
 		
 		$fields->addFieldToTab('Root.Main', new UploadField('HomepagePic', 'Homepage Pic'));
 		$fields->addFieldToTab('Root.Main', new TextField('Link', 'Link'));
 		$fields->addFieldToTab('Root.Main', new TextField('CreditLine', 'Credit Line'));


		return $fields;	
  }
  

  
  
}


