<?php
 
class ObjectOwner extends DataObject {
 
  
  private static $db = array(	
  'Title' => 'Text',
  'Website' => 'Text'
  );
  
  
  
  private static $belongs_many_many = array(
    'Subtopics' => 'Subtopic',
    'Images' => 'Image'


  );
  
  private static $plural_name = "Object owners";
  
  
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		$fields = $this->addCommonFields($fields);
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('Website', 'Website'));
 		

		return $fields;	
  }
  
  
}

