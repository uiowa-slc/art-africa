<?php

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
 
class VideoPieceHolder extends MediaHolder {

  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  // private static $allowed_children = array("AudioPiece", "VideoPiece");
  
  private static $belongs_many_many = array();
  

	// tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();

		$gridFieldConfigVideo = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("VideoPieces", "Video Pieces", VideoPiece::get(), $gridFieldConfigVideo);		
		$fields->addFieldToTab('Root.Main', $gridfield, 'Content');
		$fields->renameField("Content", "Introduction Text");

		return $fields;		
  }

}

