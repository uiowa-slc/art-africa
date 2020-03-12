<?php

use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
class Chapter extends Page {
 
  
  private static $db = array(	
  'Description' => 'Text',
  'Author' => 'Varchar(255)',
  'University' => 'Varchar(255)',
  'Tags' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(
  	'CoverImage' => Image::class
  );
  

   private static $default_child = array(
    "Subtopic"
   );
   
  private static $many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'AudioPieces' => 'AudioPiece',
   'VideoPieces' => 'VideoPiece',
   'Images' => Image::class

  
  );
  
  private static $has_many = array('EssayPages' => 'EssayPage');
  
  private static $belongs_many_many = array(
  
  );
  


  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		$fields = $this->addCommonFields($fields);
		$fields->removeFieldFromTab('Root.Main', 'Content');
		
		$gridFieldConfigEssayPages = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigEssayPages->addComponent(new GridFieldSortableRows('PageNo'));
		$gridFieldConfigEssayPages->getComponentByType(GridFieldAddExistingAutocompleter::class)->setSearchFields(array('PageNo', 'Content'));
		$gridFieldConfigEssayPages->getComponentByType(GridFieldPaginator::class)->setItemsPerPage(20);
		
		$gridfield = new GridField("EssayPages", "Introduction Essay Pages", $this->EssayPages(), $gridFieldConfigEssayPages);
		$fields->addFieldToTab('Root.Main', $gridfield);
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Chapter Name'), 'URLSegment');
		$fields->addFieldToTab('Root.Main', new UploadField('CoverImage', 'Cover Image'));
		//$fields->addFieldToTab('Root.Main', new TextAreaField('Description', 'Topic Description'));
		$fields->addFieldToTab('Root.Main', new TextField('Author', 'Author'));
		$fields->addFieldToTab('Root.Main', new TextField('University', 'University'));

		$fields->addFieldToTab('Root.Main', new TextField('Tags', 'Tags'));


		
	
		
		return $fields;		
  }

  public function Author(){
    return $this->Author;
  }


  public function CoverPhoto(){
  	$image = $this->Images()->sort('RAND()')->first();
  	return $image;

  }
  
  
  

}
