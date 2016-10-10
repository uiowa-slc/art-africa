<?php

class MediaFilterForm extends Form {
 
    public function __construct($controller, $name, $filters = 
        array("Country" => "",
              "People" => "",
              "Chapter" => "",
              "Subtopic" => "",
              "Type" => "",
              "Museum" => ""
            )) {
            
        $audioPieces = AudioPiece::get()->First();
   
		if ($audioPieces) {
			  $mediaFormTypes = array("Image" => "Image", "ArtPhoto" => "Art Photo", "FieldPhoto" => "Field Photo", "AudioPiece" => "Audio","VideoPiece" => "Video");
		} else {
			$mediaFormTypes = array("Image" => "Image", "ArtPhoto" => "Art Photo", "FieldPhoto" => "Field Photo", "VideoPiece" => "Video");
		}
        $fields = new FieldList(
            TextField::create('Title', 'Object Title')->setAttribute('placeholder', 'Object Name Contains'),
            DropdownField::create("Country", "Countries", Country::get()->map('ID','Title'), $filters['Country'])->setEmptyString('Any Country'),
            DropdownField::create("People", "Peoples", People::get()->map('ID','Title'), $filters['People'])->setEmptyString('Any People'),
            DropdownField::create("Chapter", "Chapters", Chapter::get()->map('ID','Title'), $filters['Chapter'])->setEmptyString('Any Chapter'),
            DropdownField::create("Museum", "Museums", Museum::get()->map('ID','Title'), $filters['Museum'])->setEmptyString('Any Museum'),                                
            DropdownField::create("MediaType", "MediaType", $mediaFormTypes, $filters['MediaType'])
        );
        $actions = new FieldList(FormAction::create("", "Use Filter"));
        $this->setFormMethod("GET");

        parent::__construct($controller, $name, $fields, $actions);
        $this->disableSecurityToken();
    }

     
    public function login(array $data, Form $form) {
        // Authenticate the user and redirect the user somewhere
        Controller::curr()->redirectBack();
    }
}


?>
