<?php
class MyIndex extends SolrIndex {
    function init() {
        $this->addClass('CollectionPiece');
        $this->addAllFulltextFields();
    }
}