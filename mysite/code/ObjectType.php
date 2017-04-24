<?php
 
class ObjectType extends DataObject {
 
  
  private static $db = array(	
    'Title' => 'Text',
  );
  
  
  
  private static $belongs_many_many = array(
    'Images' => 'Image'

  );
  
  private static $plural_name = "Object Types";
  
  public function canView($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canEdit($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canDelete($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canCreate($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }    
  
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
 		

		return $fields;	
  }

  public function Link(){
    $link = 'media/index?ObjectType='.$this->ID;
    return $link;
  }
  
  
}

