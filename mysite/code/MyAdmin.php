<?php
class MyAdmin extends ModelAdmin {
  private static $managed_models = array('CollectionPiece', 'CollectionHolderPage'); // Can manage multiple models
  private static $url_segment = 'collection-pieces'; // Linked as /admin/products/
  private static $menu_title = 'Collection Pieces';
}

?>