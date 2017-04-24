<?php
class FixMajorPeoplesFieldTask extends BuildTask {

    protected $title = "Fix Major Peoples Field";
    protected $description = 'Builds relationships between peoples + countries based on the text field in Country: "MajorPeoples"';
    protected $enabled = false;
    
    
	function run($request) {
		$this->buildRelationships();
	}
 
    function buildRelationships() {

    	$countries = Country::get();
    	$peoples = People::get();
    	echo "<h1>Fixing Major Peoples Relationships</h1>";
    	echo "<ul>";
    	foreach($countries->getIterator() as $country){
    		
    		if($country->MajorPeoples){
    			echo "<li>";
    			//echo $country->Title.' has '.$country->MajorPeoples.' as its MajorPeoples <br />';

    			$countryPeoples = explode(', ', $country->MajorPeoples);
    			echo $country->Title .": ";
    			print_r($countryPeoples);

    			foreach($countryPeoples as $people){
    				echo "Finding a people object with the Title ".$people."<br />";
    				$peopleObject = People::get()->filter(array('Title' => $people))->first();;

    				if($peopleObject){
    					echo('<strong>'.$peopleObject->Title. ' found!</strong><br />');
    				}

    			}
    			echo "</li>";

    			
    		}

    	} //end foreach 

    	echo "</ul>";
    	 

	}
}