<?php

 
class BibliographyHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
   
  private static $allowed_children = array("BibliographyPage");
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		
		
		return $fields;		
  }
  

}



