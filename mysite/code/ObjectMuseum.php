<?php

use SilverStripe\Assets\Image;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
 
class ObjectMuseum extends DataObject {
 
  
  private static $db = array(	
  'Title' => 'Text',
  'Website' => 'Text'
  );
  
  
  
  private static $belongs_many_many = array(
    'Images' => Image::class,
    'MediaPieces' => 'MediaPiece'

  );
  
  private static $singular_name = 'Museum';
  private static $plural_name = 'Museums';
  
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
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('Website', 'Website'));
 		

		return $fields;	
  }
  public function Link(){
    $link = 'media/index?ObjectMuseum='.$this->ID;
    return $link;
  }  
  
}

