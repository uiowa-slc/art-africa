<?php
class MyAdmin extends ModelAdmin {
  public static $managed_models = array('CollectionPiece', 'CollectionHolderPage'); // Can manage multiple models
  static $url_segment = 'collections'; // Linked as /admin/products/
  static $menu_title = 'Collections';
}

?>