<?php
class CollectionHolderPage extends Page {

   public static $has_many = array(
   );
  
   public function getCMSFields() {
	   
   	$fields = parent::getCMSFields();
		
			
	return $fields;		
  }

}
class CollectionHolderPage_Controller extends Page_Controller {

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
	public static $allowed_actions = array (
	'queryTest'
	);

	public function init() {
		parent::init();

		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still work
		Requirements::themedCSS('reset');
		Requirements::themedCSS('layout'); 
		Requirements::themedCSS('typography'); 
		Requirements::themedCSS('form'); 
	}
	
	public function queryTest(){
		$query = new SearchQuery();
		$query->search('Death');
		//$results = singleton('MyIndex')->search($query);
		//print_r($results);

		//sleep(5);
		print_r("<br><br>LOOP<br>");
		foreach ($results as $result){
			print_r($result);
			//print_r($result->ID);
			//print_r($result->Title);
			//print_r($result->Description);
			print_r("HI");
			
		}
	}

}