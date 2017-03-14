<?php
 
class ObjectType extends DataObject {
 
  
  private static $db = array(	
    'Title' => 'Text',
  );
  
  
  
  private static $belongs_many_many = array(
    'Images' => 'Image'

  );
  
  private static $plural_name = "Object Types";
  
  
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

