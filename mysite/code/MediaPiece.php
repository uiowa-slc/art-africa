<?php

use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;
 
class MediaPiece extends DataObject {
 
  
  private static $db = array(	
  'Title' => 'Text',
  'Caption' => 'HTMLText',
  'Tags' => 'Varchar(255)',
  'Description' => 'HTMLText',
  'MediaLink' => 'Varchar(255)'


  );
  
  private static $plural_name = "Media Pieces";


  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
 		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Caption', 'Caption'));
 		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Description', 'Description'));
 		
		return $fields;		
  }
  
    public function formattedIFrameURL(){
  	  $link = $this->MediaLink;
  	  
  	  //Breaks up link into query and path
  	  $parsedLink = parse_url($link);
  	  
  	  if (isset($parsedLink['query'])){
        $query = $parsedLink['query'];
        parse_str($query);
	  	 if (isset($v)){
	  	 	$URLFragment = $v;
	  	 }
  	  	 return $URLFragment;
    }
      //Assuming a query string for video wasn't returned by the above if clause...
  	  if (isset($parsedLink['path'])){
  	  	$URLFragment = $parsedLink['path'];
  	  	return $URLFragment;
  	  }
  }
  
}


