<?php
 
class Photo extends DataObject {
 
  
  private static $db = array(
  'Name' => 'Text',
  'PhotoID' => 'Text',
  'Photographer' => 'Text',
  'Description' => 'Text',
  'Date' => 'Date',
  'Location' => 'Text',
  'CreditLine' => 'Text',
  'Tags' => 'Text',
  
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
    'Picture' => 'Image'

  );
  
  private static $plural_name = "Photos";
  

  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID', 'Database ID.  Use this to get a photo using a short code' ));
 		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('PhotoID', 'Photo ID'));
 		$fields->addFieldToTab('Root.Main', new UploadField('Picture', 'Picture'));
 		$fields->addFieldToTab('Root.Main', new TextField('Photographer', 'Photographer'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Description'));

 		$fields->addFieldToTab('Root.Main', new TextField('Date', 'Date')); 

 		
 		$fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
 		 		
 		$creditField = new TextField('CreditLine', 'Credit Line');
 		$fields->addFieldToTab('Root.Main', $creditField);
 		
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));

 		
		return $fields;		
  }
   
  

  /*
  public function getCMSValidator(){
	  return new RequiredFields('CreditLine');
  }
  */
  

}


