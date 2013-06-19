<?php
 
class EssayPage extends DataObject {
 
  
  private static $db = array(	
  'Content' => 'HTMLText',
  'PageNo' => 'Int'
  );
 
  
  private static $default_sort = 'PageNo';

  private static $has_one = array(
  'Subtopic' => 'Subtopic',
  'Essay' => 'Essay');
  
  static $searchable_fields = array('PageNo', 'Content');
  
  private static $summary_fields = array('PageNo', 'Content');
  
  private static $plural_name = 'Essay Pages';

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
  
	  $fields = parent::getCMSFields();
	  
	  $fields->addFieldToTab('Root.Main', new HTMLEditorField('Content'));
	  
	  return $fields;
	 			
  }
}


class EssayPage_Controller extends ContentController {

	
	public function HI(){
		print_r("Hi");
	}
	
}
  
  
    



