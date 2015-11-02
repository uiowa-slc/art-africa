<?php

class HomePage extends Page {

	private static $db = array(	

	);

  // One-to-one relationship with gallery page
	private static $has_one = array(
		'TestPic' => 'Image'
		);

	private static $has_many = array(
		'HomepagePics' => 'HomepagePic'
	);

	private static $belongs_many_many = array();


	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigFieldPhotos->addComponent(new GridFieldSortableRows('PicNo'));
		$gridFieldConfigFieldPhotos->getComponentByType('GridFieldAddExistingAutocompleter')->setSearchFields(array('CreditLine', 'PageLink'));

		$gridfield = new GridField("HomepagePics", "Homepage Pictures", $this->HomepagePics(), $gridFieldConfigFieldPhotos);
		$fields->addFieldToTab('Root.Main', $gridfield);

		return $fields;		
	}


}


class HomePage_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array ();
	
	public function init() {
		parent::init();
		Requirements::css("themes/africa/css/homepage.css");
	}
	public function getCountryHolder(){
		$holder = CountryHolder::get()->First();
		if (isset($holder)){
			return $holder->Link();
		}
	}
	
	public function getPeopleHolder(){
		$holder = PeopleHolder::get()->First();
		//if (isset($holder)){
		return $holder->Link();
		//}
	}
	
	public function getAudioPieceHolder(){
		$holder = AudioPieceHolder::get()->First();
		if (isset($holder)){
			return $holder->Link();
		}
	}
	
	public function getVideoPieceHolder(){
		$holder = VideoPieceHolder::get()->First();
		if (isset($holder)){
			return $holder->Link();
		}
	}
	
	public function getImageHolder(){
		$holder = ImageHolder::get()->First();
		if (isset($holder)){
			return $holder->Link();
		}
	}
	
	public function getEssayHolder(){
		$holder = EssayHolder::get()->First();
		if (isset($holder)){
			return $holder->Link();
		}
	}
	
}
