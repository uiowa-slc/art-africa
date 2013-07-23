<?php
 
class HomepagePic extends DataObject {
 
  
  private static $db = array(
  'PageLink' => 'Text',
  'CreditLine' => 'Text',
  'PicNo' => 'Int'
    );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  'HomepagePic' => 'Image',
  'HomePage' => 'HomePage'
  );
  
  static $searchable_fields = array('PicNo', 'PageLink');
  
  private static $summary_fields = array('PageLink', 'CreditLine');
  
  private static $default_sort='PicNo';
  
  private static $many_many = array(
  
  );
  private static $belongs_many_many = array(
 
  
  );
  
  
  
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		
 		
 		/*$fields->addFieldToTab('Root.Main', new UploadField('HomepagePic', 'Homepage Pic'));
 		$fields->addFieldToTab('Root.Main', new TextField('PageLink', 'Link (include http:// at beginning)'));
 		$fields->addFieldToTab('Root.Main', new TextField('CreditLine', 'Credit Line'));*/
 		$fields->removeByName('HomePageID');
 		$fields->removeByName('PicNo');

		return $fields;	
  }
  

  
  
}


