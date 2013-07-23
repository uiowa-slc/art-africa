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
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/	
		//$fields->addFieldToTab('Root.Main', new UploadField('HomepagePics', 'Homepage Pictures', $this->HomepagePics()));
		
			
		$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigFieldPhotos->addComponent(new GridFieldManyRelationHandler());
		$gridFieldConfigFieldPhotos->addComponent(new GridFieldSortableRows('PicNo'));
		$gridFieldConfigFieldPhotos->getComponentByType('GridFieldAddExistingAutocompleter')->setSearchFields(array('CreditLine', 'PageLink'));
	
			/*$gridFieldConfigEssayPages->addComponent(new GridFieldSortableRows('PageNo'));
		$gridFieldConfigEssayPages->getComponentByType('GridFieldAddExistingAutocompleter')->setSearchFields(array('PageNo', 'Content'));*/
		
		$gridfield = new GridField("HomepagePics", "Homepage Pictures", $this->HomepagePics(), $gridFieldConfigFieldPhotos);
		$fields->addFieldToTab('Root.Main', $gridfield);
		
		/*$gridFieldConfigFieldPhotosViewer = GridFieldConfig_RecordViewer ::create(); 
		$gridfield = new GridField("Picture Possibilities", null, Image::get(), $gridFieldConfigFieldPhotosViewer);
		$fields->addFieldToTab('Root.Main', $gridfield);*/
		
		$fields->removeFieldFromTab("Root.Main","Content");
        
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
	/*
	public function getHomepagePics(){
		$homepagePics = homepagePics::get()->
	}
	*/
	
}
