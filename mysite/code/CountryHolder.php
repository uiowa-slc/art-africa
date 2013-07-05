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
			
		$gridFieldConfigCountry = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("Countries", "Countries", Country::get(), $gridFieldConfigCountry);		
		$fields->addFieldToTab('Root.Main', $gridfield, 'Content');
		$fields->renameField("Content", "Introduction Text");
		
		
		/*
		
		$gridFieldConfigPeople = GridFieldConfig_RecordEditor::create(); 
		$gridfield = new GridField("People", "Peoples", People::get(), $gridFieldConfigPeople);		
		$fields->addFieldToTab('Root.Main', $gridfield, 'Content');
		$fields->renameField("Content", "Introduction Text");
		
		*/
		return $fields;		
  }
  

}


class CountryHolder_Controller extends Page_Controller {

	private static $allowed_actions = array ('show', 'getCountries');
	
	public static $childPage = 'Country';
	
	public function getCountries(){
	$country = Country::get();
	return $country;
	}
	
	
	public function getCustomFields(){
	  	$fields = DataObject::custom_database_fields('Country');
	  	$returnArray = new ArrayList();
	  	foreach ($fields as $fieldKey => $fieldValue){
	  	    $newArray = array('Test' => $fieldKey);
	  		$newArrayData = new ArrayData($newArray);
	  		$returnArray->add($newArrayData);
	  	}
	  	
	  	//$iterator = $returnArray->getIterator();

		return $returnArray;
	}
  
  
	public function getRelations(){
		$allRelationships = new ArrayList();
		
		foreach(Country::$many_many as $relationshipKey => $relationshipValue){
		    $newArray = array('Test' => $relationshipKey);
	  		$newArrayData = new ArrayData($newArray);
	  		$allRelationships->add($newArrayData);  
		  }
		  
	
		return $allRelationships;
	}

}
