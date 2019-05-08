<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class HomePage extends Page {

	private static $db = array(	

	);

  // One-to-one relationship with gallery page
	private static $has_one = array(
		'TestPic' => Image::class
		);

	private static $has_many = array(
		'HomepagePics' => 'HomepagePic'
	);

	private static $belongs_many_many = array();


	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigFieldPhotos->addComponent(new GridFieldSortableRows('PicNo'));
		$gridFieldConfigFieldPhotos->getComponentByType(GridFieldAddExistingAutocompleter::class)->setSearchFields(array('CreditLine', 'PageLink'));

		$gridfield = new GridField("HomepagePics", "Homepage Pictures", $this->HomepagePics(), $gridFieldConfigFieldPhotos);
		$fields->addFieldToTab('Root.Main', $gridfield);

		return $fields;		
	}


}
