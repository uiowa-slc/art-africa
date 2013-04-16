<?php
class MyIndex extends SolrIndex {
    function init() {
    	$this->addClass('SiteTree');
    	//$this->addClass('CollectionPiece');
    	$this->addFulltextField('Title'); 
    	//$this->addFulltextField('ArtistName'); 
    }
}