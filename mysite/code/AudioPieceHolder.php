<?php

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;

class AudioPieceHolder extends MediaHolder {


	private static $db = array(

	);

	// One-to-one relationship with gallery page
	private static $has_one = array(

	);

	//private static $allowed_children = array( "AudioPiece", "VideoPiece" );

	private static $belongs_many_many = array();


	// tidy up the CMS by not showing these fields
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$gridFieldConfigAudio = GridFieldConfig_RecordEditor::create();
		$gridfield = new GridField( "AudioPieces", "Audio Pieces", AudioPiece::get(), $gridFieldConfigAudio );
		$fields->addFieldToTab( 'Root.Main', $gridfield, 'Content' );
		$fields->renameField( "Content", "Introduction Text" );


		return $fields;
	}


}

