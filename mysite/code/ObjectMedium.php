<?php

use SilverStripe\Assets\Image;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
 
class ObjectMedium extends DataObject {
 
  
  private static $db = array(	
    'Title' => 'Text',
  );
  
  
  
  private static $belongs_many_many = array(
    'Images' => Image::class

  );
  
  private static $plural_name = "Object Mediums";

  public function canView($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canEdit($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canDelete($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canCreate($member = null, $context=null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }  
  
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name (singular noun preferred)'));
 		

		return $fields;	
  }
  
  public function Link(){
    $link = 'media/index?ObjectMedium='.$this->ID;
    return $link;
  }  
}

