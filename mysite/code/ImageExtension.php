<?php
 
class ImageExtension extends DataExtension {
 
  private static $db = array(
        'PageNo' => 'Int',
    );
  private static $has_one = array(
        'HomePage' => 'HomePage',
    );
}


