<?php
 
class CountryHolder extends Page {
 
  
  private static $db = array(	

  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  private static $allowed_children = array("Country");
  
 
  
 
  
  private static $belongs_many_many = array();
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		/*$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		$fields->removeFieldFromTab("Root.Main","SortOrder");*/
		
		$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", Country::get(), $gridFieldConfigCountries);		
		$fields->addFieldToTab('Root.Countries', $gridfield);
		
		
		return $fields;		
  }
  

}


class CountryHolder_Controller extends Page_Controller {

	private static $allowed_actions = array ('show');

	
	public function show (){
	//Displays a data object
	
						
		$class = 'Country';
		
		$objectID = $this->request->param('ID');
		
	
		
		if ($objectID){
		
		    $object = $class::get_by_id($class, $objectID);
		    
		    return print_r($object); 
		    
		    if(isset($object)){
		       $showTemplate = $class . 'Holder_show';
			   return $this->Customise($object)->renderWith(array($showTemplate, 'Page'));
			   
		    }else{
		    }		   
		}
		else {
			return $this->renderWith('Page');
		}
	
	}
	
	
	
	
}