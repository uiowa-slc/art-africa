<?php
 
class MediaPiece extends DataObject {
 
  
  private static $db = array(	
  'History' => 'Text',
  'Bibliography' => 'Text',


  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  'MediaFile' => 'File'
  
  
  

  );
  

     
     
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('History', 'History'));
 		$fields->addFieldToTab('Root.Main', new TextField('Bibliography', 'Bibliography'));
 		$fields->addFieldToTab('Root.Main', new UploadField('MediaFile', 'Media File'));
 		


 		
		return $fields;		
  }
  
}


