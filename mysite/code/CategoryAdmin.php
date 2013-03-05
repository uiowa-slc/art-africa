<?php
class CategoryAdmin extends ModelAdmin {
  public static $managed_models = array('Category'); // Can manage multiple models
  static $url_segment = 'categories'; // Linked as /admin/products/
  static $menu_title = 'Categories';
}

?>