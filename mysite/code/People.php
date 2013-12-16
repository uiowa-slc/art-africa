<?php
 
class People extends DataObject {
 
  
  private static $db = array(	
  'Title' => 'Text',
  'AlternateNames' => 'HTMLText',
  'Location' => 'HTMLText',
  'Languages' => 'HTMLText',
  'Population' => 'HTMLText',
  'Neighbors' => 'HTMLText',
  'TypesOfArt' => 'HTMLText',
  'History' => 'HTMLText',
  'Economy' => 'HTMLText',
  'PoliticalSystems' => 'HTMLText',
  'Religion' => 'HTMLText',
  'Tags' => 'Text'

  );
 
  private static $has_one = array(
  'Picture' => 'Image'

  );
  
  private static $many_many = array(
  'Essays' => 'Essay',
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  'Images' => 'Image'
  
  );
  
  private static $belongs_many_many = array(
  'Subtopics' => 'Subtopic',
  'Countries' => 'Country',
  'Chapters' => 'Chapter'

  );
  
  private static $plural_name = "Peoples";
  

 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
 		$fields = $this->addCommonFields($fields);
 		$fields->addFieldToTab('Root.Main', new ReadonlyField('ID', 'Temporary ID Field'));		
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('AlternateNames', 'Alternate Name(s)'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Location', 'Location'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Languages', 'Languages'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Population', 'Population'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Neighbors', 'Neighbors'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('TypesOfArt', 'Types Of Art'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('History', 'History'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Economy', 'Economy'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('PoliticalSystems', 'Political Systems'));
		$fields->addFieldToTab('Root.Main', new HTMLEditorField('Religion', 'Religion'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
		$fields->addFieldToTab('Root.Main', new UploadField('Picture', 'Picture'));

		return $fields;		
  }
  
  public function Link(){
	  
	  $peopleHolder = DataObject::get_one("PeopleHolder");
	  $peopleTitle = $this->Title;
	  $peopleTitle = urlencode($peopleTitle);
	  $link = $peopleHolder->Link().'show/'.$peopleTitle;
	  
	  return $link;
  }
}



  
  




