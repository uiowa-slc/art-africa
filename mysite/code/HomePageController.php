
<?php
class HomePageController extends PageController {

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
		// Requirements::css("themes/africa/css/homepage.css");
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
