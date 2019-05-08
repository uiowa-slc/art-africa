<?php

use SilverStripe\Assets\Image;
use SilverStripe\Security\Permission;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
 
class Essay extends DataObject {
 
  
  private static $db = array(
  'AuthorFirstName' => 'Text',	
  'AuthorLastName' => 'Text',
  'Content' => 'Text',	
  'DateWritten' => 'Text',	
  'University' => 'Text',	
  'Consultant' => 'Text',	
  'Title' => 'Text',	
  'Source' => 'Text',	
  'Bibliography' => 'Text',
  'Tags' => 'Text'
  );
 
  // One-to-one relationship with gallery page
  private static $has_one = array(

  );
  
  
  private static $many_many = array(
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  'Images' => Image::class
  
  );
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Countries' => 'Country',
  'People' => 'People',
  'Chapters' => 'Chapter'

  
  );
    public function canView($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canEdit($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canDelete($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canCreate($member = null, $context=null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  } 
  private static $has_many = array('EssayPages' => 'EssayPage');
  
  private static $plural_name = "Essays";

  public function Relations(){
  	$subtopics = $this->Subtopics();
  	$countries = $this->Countries();
  	$people = $this->People();
  	$chapters = $this->Chapters();

  	$relations = new ArrayList();

  	$relations->merge($subtopics);
  	$relations->merge($countries);
  	$relations->merge($people);
  	$relations->merge($chapters);

  	return $relations;
  }

  public function Author(){
  	return $this->AuthorFirstName.' '.$this->AuthorLastName;
  }

  public function getCMSFields() {
  
 		$fields = parent::getCMSFields();
 		$fields = $this->addCommonFields($fields);
 		 //$fields->removeByName('');
 		 
 		$gridFieldConfigEssayPages = GridFieldConfig_RelationEditor::create(); 
		$gridFieldConfigEssayPages->addComponent(new GridFieldSortableRows('PageNo'));
		$gridFieldConfigEssayPages->getComponentByType(GridFieldAddExistingAutocompleter::class)->setSearchFields(array('PageNo', 'Content'));
		$gridFieldConfigEssayPages->getComponentByType(GridFieldPaginator::class)->setItemsPerPage(20);
		$gridfield = new GridField("EssayPages", "Essay Pages", $this->EssayPages(), $gridFieldConfigEssayPages);
		$fields->addFieldToTab('Root.Main', $gridfield);
 		
 		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Title'));
 		$fields->addFieldToTab('Root.Main', new TextField('AuthorFirstName', 'Author First Name'));
 		$fields->addFieldToTab('Root.Main', new TextField('AuthorLastName', 'Author Last Name'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Content', 'Content'));
 		$fields->addFieldToTab('Root.Main', new TextField('DateWritten', 'Date Written'));
 		$fields->addFieldToTab('Root.Main', new TextField('University', 'University'));
 		$fields->addFieldToTab('Root.Main', new TextField('Consultant', 'Consultant'));
 		$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Bibliography', 'Bibliography'));
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
 		//$fields->removeFieldByName('EssayPages');

		return $fields;	
  }
  

  
  
}


