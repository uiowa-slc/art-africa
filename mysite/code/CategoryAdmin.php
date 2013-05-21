<?php
class CategoryAdmin extends ModelAdmin {
  private static $managed_models = array('Category'); // Can manage multiple models
  private static $url_segment = 'categories'; // Linked as /admin/products/
  private static $menu_title = 'Categories';
}

?>