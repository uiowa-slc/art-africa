<?php
 
class SiteConfigExtension extends DataExtension {
  
  private static $db = array( 
    "FooterInfo" => "HTMLText",

  );
  
  public function updateCMSFields( FieldList $fields ) {

    $fields->addFieldToTab('Root.Main', new HTMLEditorField("FooterInfo","Footer Info"));

    return $fields;   
  }
}
