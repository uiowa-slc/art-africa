<?php
 
class Category extends DataObject {
 
  
  private static $db = array(	
	  'Title' => 'Varchar',
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $belongs_many_many = array("CollectionPieces" => "CollectionPiece");
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		return $fields;		
  }
  

}