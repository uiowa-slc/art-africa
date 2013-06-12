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
  'Location' => 'Text'
  
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
    'Picture' => 'Image'

  );
  

  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('Photo', 'Photo ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Name'));
 		$fields->addFieldToTab('Root.Main', new UploadField('Picture', 'Picture'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Description'));
 		$fields->addFieldToTab('Root.Main', new TextField('Photographer', 'Photographer'));
 		
 		 		
 		$creditField = new TextField('CreditLine', 'Credit Line');
 		$fields->addFieldToTab('Root.Main', $creditField);
 		
 		$fields->addFieldToTab('Root.Main', $dateField = new DateField('Date', 'Date')); 
 		$dateField->setConfig('showcalendar', true);
 		$dateField->setConfig('dateformat', 'MM/dd/YYYY');
 		
 		
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));

 		
		return $fields;		
  }
   
  	public function onBeforeWrite(){
  		//print_r($this->CreditLine);
		if ($this->CreditLine == ''){
			return;
		}
		
		parent::onBeforeWrite();
	}
	

  /*
  public function getCMSValidator(){
	  return new RequiredFields('CreditLine');
  }
  */
  

}


