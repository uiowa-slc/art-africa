<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;
 
class SiteConfigExtension extends DataExtension {
  
  private static $db = array( 
    "FooterInfo" => "HTMLText",

  );
  
  public function updateCMSFields( FieldList $fields ) {

    $fields->addFieldToTab('Root.Main', new HTMLEditorField("FooterInfo","Footer Info"));

    return $fields;   
  }
}
