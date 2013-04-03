<?php
class MyIndex extends SolrIndex {
    function init() {
        $this->addClass('Page');
        $this->addAllFulltextFields();
    }
}