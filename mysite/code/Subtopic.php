<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class Subtopic extends Page {


	private static $db = array(
		'Description' => 'Text',
		'Tags' => 'Text',
	);

	private static $has_one = array(
		'CoverImage' => Image::class
	);

	private static $many_many = array(
		'People' => 'People',
		'Essays' => 'Essay',
		'Countries' => 'Country',
		'AudioPieces' => 'AudioPiece',
		'VideoPieces' => 'VideoPiece',
		// 'ArtPhotos' => 'ArtPhoto',
		// 'FieldPhotos' => 'FieldPhoto',
		'Images' => Image::class
	);

	private static $has_many = array( 'EssayPages' => 'EssayPage' );



	private static $belongs_many_many = array(
	);

	private static $plural_name = "Subtopics";


	// tidy up the CMS by not showing these fields
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		//$fields = $this->addCommonFields( $fields );

		$fields->removeFieldFromTab( 'Root.Main', 'Content' );
		$fields->addFieldToTab( 'Root.Main', new TextField( 'Title', 'Topic Name' ) );
		//$fields->addFieldToTab( 'Root.Main', new UploadField( 'CoverImage', 'Cover Image' ) );
		$gridFieldConfigEssayPages = GridFieldConfig_RelationEditor::create();
		$gridFieldConfigEssayPages->addComponent( new GridFieldSortableRows( 'PageNo' ) );
		$gridFieldConfigEssayPages->getComponentByType( GridFieldAddExistingAutocompleter::class )->setSearchFields( array( 'PageNo', 'Content' ) );
		$gridFieldConfigEssayPages->getComponentByType( GridFieldPaginator::class )->setItemsPerPage( 20 );
		$gridfield = new GridField( "EssayPages", "Essay Pages", $this->EssayPages(), $gridFieldConfigEssayPages );
		$fields->addFieldToTab( 'Root.Main', $gridfield );

		$fields->addFieldToTab( 'Root.Main', new TextField( 'Tags', 'Tags' ) );

		return $fields;

	}

	public function Author(){
		if($this->Parent())
			return $this->Parent()->Author;
	}

	public function University(){
		if($this->Parent())
			return $this->Parent()->University;
	}
}
