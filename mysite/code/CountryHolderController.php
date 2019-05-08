<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
class CountryHolderController extends PageController {

	private static $allowed_actions = array ('show', 'getCountries', 'loadTest');
	
	public static $childPage = 'Country';
	
	public function getCountries(){
	$country = Country::get()->sort('Title');
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
	
	public function loadTest() {
		for ($iter = 0; $iter <= 10; $iter++) {
			$video = AudioPiece::get()->First();
			$newVideo = $video->duplicate();
		}
	}
}