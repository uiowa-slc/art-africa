<?php

class MediaFilterForm extends Form
{


    public function __construct($controller, $name, 

        $filters =
            array('Country' => '',
                'People' => '',
                'Chapter' => '',
                'Subtopic' => '',
                'MediaType' => '',
                'ObjectType' => '',
                'ObjectMuseum' => '',
                'ObjectCollection' => '',
                'ObjectMedium' => '',
                'CreditLine' => '',
                'ObjectTitle' => '',
                'Photographer' => '',
            )) 

    {


        $audioPieces = AudioPiece::get()->First();

        if ($audioPieces) {
            $mediaFormTypes = array('Image' => 'Image', 'ArtPhoto' => 'Art Photo', 'FieldPhoto' => 'Field Photo', 'AudioPiece' => 'Audio', 'VideoPiece' => 'Video');
        } else {
            $mediaFormTypes = array('Image' => 'Image', 'ArtPhoto' => 'Art Photo', 'FieldPhoto' => 'Field Photo', 'VideoPiece' => 'Video');
        }

        $objectTitleField = TextField::create('ObjectTitle', 'Object Title')->setAttribute('placeholder', 'Object Title Contains');
        if($filters['ObjectTitle'] != ''){
            $objectTitleField->setValue($filters['ObjectTitle']);
        }

        $photographerField = TextField::create('Photographer', 'Photographer')->setAttribute('placeholder', 'Photographer Contains');
        if($filters['Photographer'] != ''){
            $photographerField->setValue($filters['Photographer']);
        }     

        $creditLineField = TextField::create('CreditLine', 'CreditLine')->setAttribute('placeholder', 'Credit Line Contains');
        if($filters['CreditLine'] != ''){
            $creditLineField->setValue($filters['CreditLine']);
        } 

        $fields = new FieldList(
            //COMMENTING THESE OUT UNTIL WE GO LIVE!!
            // $objectTitleField,
            // $photographerField,
            // $creditLineField,
            // LiteralField::create('MediaFilterSep1', '<hr>'),
            // DropdownField::create('ObjectType', 'Type', ObjectType::get()->map('ID', 'Title'), $filters['ObjectType'])->setEmptyString('Any Type'),
            // DropdownField::create('ObjectMuseum', 'Museum', ObjectMuseum::get()->map('ID', 'Title'), $filters['ObjectMuseum'])->setEmptyString('Any Museum'),
            // DropdownField::create('ObjectCollection', 'Collection', ObjectCollection::get()->map('ID', 'Title'), $filters['ObjectCollection'])->setEmptyString('Any Collection'),
            // DropdownField::create('ObjectMedium', 'Medium', ObjectMedium::get()->map('ID', 'Title'), $filters['ObjectMedium'])->setEmptyString('Any Medium'),

            //END COMMENTOUT

            DropdownField::create('MediaType', 'MediaType', $mediaFormTypes, $filters['MediaType']),
            LiteralField::create('MediaFilterSep2', '<hr>'),
            DropdownField::create('Country', 'Countries', Country::get()->map('ID', 'Title'), $filters['Country'])->setEmptyString('Any Country'),
            DropdownField::create('People', 'Peoples', People::get()->map('ID', 'Title'), $filters['People'])->setEmptyString('Any People'),
            DropdownField::create('Chapter', 'Chapters', Chapter::get()->map('ID', 'Title'), $filters['Chapter'])->setEmptyString('Any Chapter')

        );
        $actions = new FieldList(FormAction::create('', 'Use Filter')->setUseButtonTag(true)->addExtraClass('button--full')->setButtonContent('Use Filter <i class="fa fa-caret-right" aria-hidden="true"></i>'));
        $this->setFormMethod('GET');

        parent::__construct($controller, $name, $fields, $actions);
        $this->disableSecurityToken();
    }

    public function login(array $data, Form $form)
    {
        // Authenticate the user and redirect the user somewhere
        Controller::curr()->redirectBack();
    }
}
