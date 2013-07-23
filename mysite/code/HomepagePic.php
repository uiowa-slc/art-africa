<?php
 
class HomepagePic extends DataObject {
 
  
  private static $db = array(
  'PageLink' => 'Text',
  'CreditLine' => 'Text',
  'PageNo' => 'Int'
    );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  'HomepagePic' => 'Image',
  'HomePage' => 'HomePage'
  );
  
  static $searchable_fields = array('PageNo', 'PageLink');
  
  private static $summary_fields = array('PageNo', 'PageLink', 'CreditLine');
  
  private static $default_sort='PageNo';
  
  private static $many_many = array(
  
  );
  private static $belongs_many_many = array(
 
  
  );
  
  
  
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		
 		
 		$fields->addFieldToTab('Root.Main', new UploadField('HomepagePic', 'Homepage Pic'));
 		$fields->addFieldToTab('Root.Main', new TextField('PageLink', 'Link'));
 		$fields->addFieldToTab('Root.Main', new TextField('CreditLine', 'Credit Line'));
 		$fields->removeByName('HomePageID');

		return $fields;	
  }
  

  
  
}


