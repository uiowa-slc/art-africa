<?php
 
class AudioPiece extends MediaPiece {
 
  
  private static $db = array(	
  
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $many_many = array(
  'VideoPieces' => 'VideoPiece'
  );
  
  private static $belongs_many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'Subtopics' => 'Subtopic',
   'Chapters' => 'Chapter',
   'Images' => 'Image'
  );
  
  private static $plural_name = "Audio Pieces";

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
	



		return $fields;		
			
	
		

		
		return $fields;		
  }
  
  
  

}

