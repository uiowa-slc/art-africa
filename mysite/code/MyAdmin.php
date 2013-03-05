<?php
class MyAdmin extends ModelAdmin {
  public static $managed_models = array('CollectionPiece', 'CollectionHolderPage'); // Can manage multiple models
  static $url_segment = 'collection-pieces'; // Linked as /admin/products/
  static $menu_title = 'Collection Pieces';
}

?>