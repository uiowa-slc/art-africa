<?php

class MediaFilterForm extends Form {
 
    public function __construct($controller, $name, $filters = 
        array("Country" => "",
              "People" => "",
              "Chapter" => "",
              "Subtopic" => "",
              "Type" => ""
            )) {
            
        $audioPieces = AudioPiece::get()->First();
   
		if ($audioPieces) {
			  $mediaFormTypes = array("Image" => "Image", "ArtPhoto" => "Art Photo", "FieldPhoto" => "Field Photo", "AudioPiece" => "Audio","VideoPiece" => "Video");
			  echo('hello');
		} else {
			  $mediaFormTypes = array("Image" => "Image", "ArtPhoto" => "Art Photo", "FieldPhoto" => "Field Photo", "VideoPiece" => "Video");
			  echo('goodbye');
		}
        $fields = new FieldList(
            DropdownField::create("Country", "Countries", Country::get()->map('ID','Title'), $filters['Country'])->setEmptyString('Any Country'),
            DropdownField::create("People", "Peoples", People::get()->map('ID','Title'), $filters['People'])->setEmptyString('Any People'),
            DropdownField::create("Chapter", "Chapters", Chapter::get()->map('ID','Title'), $filters['Chapter'])->setEmptyString('Any Chapter'),                
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