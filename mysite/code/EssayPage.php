<?php

class EssayPage extends DataObject {
 
  
  private static $db = array(	
    'Content' => 'HTMLText',
    'PageNo' => 'Int'
    );
  
  
  private static $default_sort = 'PageNo';

  private static $has_one = array(
    'Subtopic' => 'Subtopic',
    'Chapter'=> 'Chapter',
    'Essay' => 'Essay');
  
  static $searchable_fields = array('PageNo', 'Content');
  
  private static $summary_fields = array('PageNo', 'Content');
  
  private static $plural_name = 'Essay Pages';


  public function getCMSFields() {
    
   $fields = parent::getCMSFields();
   
   $fields->addFieldToTab('Root.Main', new HTMLEditorField('Content'));
   $fields->removeByName('SubtopicID');
   $fields->removeByName('ChapterID');
   $fields->removeByName('EssayID');

   
   return $fields;
   
 }
}








