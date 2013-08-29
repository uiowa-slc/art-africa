<?php

class ImageExtension extends DataExtension {
		
  private static $db = array(
  
   'PhotoID' => 'Text',
  'Photographer' => 'Text',
  'Description' => 'HTMLText',
  'Date' => 'Text',
  'Location' => 'Text',
  'CreditLine' => 'HTMLText',
  'Caption' => 'HTMLText',
  'Tags' => 'Text',
  
  'Type' => "Enum('Image, ArtPhoto, FieldPhoto', 'Image')",
  
  'AccessionNumber' => 'Text',
  'TraditionalName' => 'HTMLText',
  'Material' => 'Text',
  'ArtDimensions' => 'Text',
  'Function' => 'Text',
  'Style' => 'Text',
  'Substyle' => 'Text',
  'Collection' => 'Text',
  'Source' => 'Text'
  
  );
  
  private static $many_many = array(
  'Essays' => 'Essay',
  'AudioPieces' => 'AudioPiece',
  'VideoPieces' => 'VideoPiece',
  );
  
  private static $belongs_many_many = array(
   'People' => 'People',
   'Essays' => 'Essay',
   'Countries' => 'Country',
   'Subtopics' => 'Subtopic',
   'Chapters' => 'Chapter'

  );

  private static $default_sort = "Name";
  
  private static $searchable_fields = array('Title', 'PhotoID', 'Filename', 'Name');
  

  
  private static $plural_name = "Images";  	
  
	public function updateCMSFields(FieldList $fields) {
	
		$fields = $this->owner->addCommonFields($fields);
	
		$fields->addFieldToTab('Root.Main', new TextField('Title', 'Name'));
		$fields->addFieldToTab('Root.Main', new DropdownField('Type','Type of Image', $this->owner->dbObject('Type')->enumValues()));
 		//$fields->addFieldToTab('Root.Main', new TextField('PhotoID', 'Photo ID'));
 		$fields->addFieldToTab('Root.Main', new TextField('Photographer', 'Photographer'));



 		$fields->addFieldToTab('Root.Main', new TextField('Date', 'Date')); 
 		$fields->addFieldToTab('Root.Main', new TextField('Location', 'Location'));
 		 		
 		$creditField = new HTMLEditorField('CreditLine', 'Credit Line');
 		$creditField->setRows(1);
 		$fields->addFieldToTab('Root.Main', $creditField);

    $captionField = new HTMLEditorField('Caption', 'Caption');
    $captionField->setRows(1);
 		$fields->addFieldToTab('Root.Main', $captionField);
 		
 		$fields->addFieldToTab('Root.Main', new TextAreaField('Tags', 'Tags'));
 		$fields->addFieldToTab('Root.Main', new TextField('AccessionNumber', 'Accession Number'));

 		$descriptionField = new HTMLEditorField('Description', 'Description');
    $descriptionField->setRows(2);
    $fields->addFieldToTab('Root.Main', $descriptionField);

    $traditionalNameField = new HTMLEditorField('TraditionalName', 'Traditional Name');
    $traditionalNameField->setRows(1);
    $fields->addFieldToTab('Root.Main', $traditionalNameField);

 		$fields->addFieldToTab('Root.Main', new TextField('Material', 'Material'));
 		$fields->addFieldToTab('Root.Main', new TextField('ArtDimensions', 'Dimensions'));
 		$fields->addFieldToTab('Root.Main', new TextField('Function', 'Function'));
 		$fields->addFieldToTab('Root.Main', new TextField('Style', 'Style'));
 		$fields->addFieldToTab('Root.Main', new TextField('Substyle', 'Substyle'));
 		//$fields->addFieldToTab('Root.Main', new TextField('Collection', 'Collection'));
 		//$fields->addFieldToTab('Root.Main', new TextField('Source', 'Source'));

	}

  public function ShowLink(){
    $imageHolder = ImageHolder::get_one("ImageHolder");
    return $imageHolder->Link().'show/'.$this->owner->ID;
  }

	}