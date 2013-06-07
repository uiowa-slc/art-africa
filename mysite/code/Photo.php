<?php
 
class Photo extends DataObject {
 
  
  private static $db = array(
  'Name' => 'Text',
  'Description' => 'Text',
  'TraditionalName' => 'Text',
  'Material' => 'Text',
  'Size' => 'Text',
  'Function' => 'Text',
  'Style' => 'Text',
  'Substyle' => 'Text',
  'Collection' => 'Text',
  'Source' => 'Text',	
  'Tags' => 'Text'
  

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
    'Picture' => 'Image'

  );
  

  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('Name', 'Name'));
 		$fields->addFieldToTab('Root.Main', new UploadField('Picture', 'Picture'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Description'));
 		$fields->addFieldToTab('Root.Main', new TextField('TraditionalName', 'Traditional Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('Material', 'Material'));
 		$fields->addFieldToTab('Root.Main', new TextField('Size', 'Size'));
 		$fields->addFieldToTab('Root.Main', new TextField('Function', 'Function'));
 		$fields->addFieldToTab('Root.Main', new TextField('Style', 'Style'));
 		$fields->addFieldToTab('Root.Main', new TextField('Substyle', 'Substyle'));
 		$fields->addFieldToTab('Root.Main', new TextField('Collection', 'Collection'));
 		$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));

 		
		return $fields;		
  }
  
  
  

}


