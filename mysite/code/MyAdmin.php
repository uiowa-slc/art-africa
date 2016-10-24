<?php

class CountriesAdmin extends ModelAdmin {
  private static $managed_models = array('Country'); // Can manage multiple models
  private static $url_segment = 'countries'; // Linked as /admin/products/
  private $menu_title = 'Countries';
}

class PeopleAdmin extends ModelAdmin {
  private static $managed_models = array('People'); // Can manage multiple models
  private static $url_segment = 'people'; // Linked as /admin/products/
  private static $menu_title = 'Peoples';
}

class AudioAdmin extends ModelAdmin {
  private static $managed_models = array('AudioPiece'); // Can manage multiple models
  private static $url_segment = 'audio'; // Linked as /admin/products/
  private static $menu_title = 'Audio';
}

class VideoAdmin extends ModelAdmin {
  private static $managed_models = array('VideoPiece'); // Can manage multiple models
  private static $url_segment = 'videos'; // Linked as /admin/products/
  private static $menu_title = 'Videos';
}

class EssayAdmin extends ModelAdmin {
  private static $managed_models = array('Essay'); // Can manage multiple models
  private static $url_segment = 'essays'; // Linked as /admin/products/
  private static $menu_title = 'Essays';
}

class ObjectTypeAdmin extends ModelAdmin {
  private static $managed_models = array('ObjectType'); // Can manage multiple models
  private static $url_segment = 'object-types'; // Linked as /admin/products/
  private static $menu_title = 'Object Types';
}
class ObjectOwnerAdmin extends ModelAdmin {
  private static $managed_models = array('ObjectOwner'); // Can manage multiple models
  private static $url_segment = 'object-owners'; // Linked as /admin/products/
  private static $menu_title = 'Object Owners';
}

class ObjectMediumAdmin extends ModelAdmin {
  private static $managed_models = array('ObjectMedium'); // Can manage multiple models
  private static $url_segment = 'object-mediums'; // Linked as /admin/products/
  private static $menu_title = 'Object Mediums';
}

?>