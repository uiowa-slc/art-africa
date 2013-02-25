<?php
 
class GalleryImage extends DataObject {
 
  
  public static $db = array(	
	  'SortOrder' => 'Int',
	  'Title' => 'Varchar'
  );
 
  // One-to-one relationship with gallery page
  public static $has_one = array(
    'Image' => 'Image',
    'GalleryPage' => 'GalleryPage'	
  );
 
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","GalleryPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");
		return $fields;		
  }
  
  // Tell the datagrid what fields to show in the table
   public static $summary_fields = array( 
       'ID' => 'ID',
	   'Title' => 'Title',
	   'Thumbnail' => 'Thumbnail'     
   );
  
  // this function creates the thumnail for the summary fields to use
   public function getThumbnail() { 
     return $this->Image()->CMSThumbnail();
  }
 
}