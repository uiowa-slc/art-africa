<?php

class MediaFilterForm extends Form {
 
    public function __construct($controller, $name, $filters = 
        array("Country" => "",
              "People" => "",
              "Chapter" => "",
              "Subtopic" => ""
            )) {
        $fields = new FieldList(

            DropdownField::create("Country", "Countries", Country::get()->map('ID','Title'), $filters['Country'])->setEmptyString('Any Country'),
            DropdownField::create("People", "Peoples", People::get()->map('ID','Title'), $filters['People'])->setEmptyString('Any People'),
            DropdownField::create("Chapter", "Chapters", Chapter::get()->map('ID','Title'), $filters['Chapter'])->setEmptyString('Any Chapter'),
            DropdownField::create("Subtopic", "Subtopics", Subtopic::get()->map('ID','Title'), $filters['Subtopic'] )->setEmptyString('Any Subtopic')
        );
        $actions = new FieldList(FormAction::create("login")->setTitle("Search"));
         
        parent::__construct($controller, $name, $fields, $actions);
    }
     
    public function login(array $data, Form $form) {
        // Authenticate the user and redirect the user somewhere
        Controller::curr()->redirectBack();
    }
}


?>