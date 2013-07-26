<?php
 
class People extends DataObject {
 
  
  private static $db = array(	
  'Title' => 'Text',
  'AlternateNames' => 'Text',
  'Location' => 'Text',
  'Languages' => 'Text',
  'Population' => 'Text',
  'Neighbors' => 'Text',
  'TypesOfArt' => 'Text',
  'History' => 'Text',
  'Economy' => 'Text',
  'PoliticalSystems' => 'Text',
  'Religion' => 'Text',
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
		$fields->addFieldToTab('Root.Main', new TextField('AlternateNames', 'Alternate Name(s)'));
		$fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
		$fields->addFieldToTab('Root.Main', new TextField('Languages', 'Languages'));
		$fields->addFieldToTab('Root.Main', new TextField('Population', 'Population'));
		$fields->addFieldToTab('Root.Main', new TextField('Neighbors', 'Neighbors'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('TypesOfArt', 'Types Of Art'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('History', 'History'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('Economy', 'Economy'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('PoliticalSystems', 'Political Systems'));
		$fields->addFieldToTab('Root.Main', new TextAreaField('Religion', 'Religion'));
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



  
  




