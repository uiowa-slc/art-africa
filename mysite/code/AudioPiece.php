<?php

class AudioPiece extends MediaPiece {

  private static $db = array(
  );

  private static $has_one = array(
    'AudioFile' => 'File'

  );

  private static $many_many = array(
    'VideoPieces' => 'VideoPiece'
  );

  private static $belongs_many_many = array(
    'People' => 'People',
    'Essays' => 'Essay',
    'Countries' => 'Country',
    'Subtopics' => 'Subtopic',
    'Chapters' => 'Chapter',
    'Images' => 'Image'
  );

  private static $plural_name = "Audio Pieces";
  public function canView($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canEdit($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canDelete($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  }

  public function canCreate($member = null) {
      return Permission::check('CMS_ACCESS', 'any', $member);
  } 
  public function getCMSFields() {
    $fields = parent::getCMSFields();

    $fields = $this->addCommonFields( $fields );
    $fields->addFieldToTab( 'Root.Main', new UploadField( 'AudioFile', 'Audio File (local):' ), 'ID' );
    $fields->removeByName( 'MediaLink' );

    return $fields;

  }

}
