<?php
class CreateDummyArtTask extends BuildTask {

    protected $title = "Generate dummy art pieces";
    protected $description = 'Fill up the database with test collection items';
    protected $enabled = false;
    
    
	function run($request) {
		//commenting out because hoo boy if this was ran on accident it would destroy the site at this point.
		//$this->generateDummyImages();
	}
 
    function generateDummyImages() {
    	 $totalItems = 1000;
    	for($i = 0; $i < $totalItems; $i++){
	    	
	    	$piece = null;
	    	$piece = new CollectionPiece();
	    	
	    	$piece->Title = 'Hex '.$i;
	    	$piece->ArtistName = 'Andy Gilmore';
	    	$piece->Description = 'test description';
	    	$piece->CollectionHolderPageID = 6;
	    	$piece->ImageID = $i;
	    	
	    	echo "writing dummy piece #".$i."<br />";
	    	$piece->write();
	    	
    	}
    	 

	}
}