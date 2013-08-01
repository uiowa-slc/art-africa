<?php
 
class PaginatedImageList extends PaginatedList {
 	public static $position = 0; 
 	
    function getNextLink(){
       $this::$position++;
	   print_r("<br><br><br><br><br>POSITION!!");
	   print_r($position);
	   return;
	   parent::getNextLink();
	 }

     public function init(){
     	 parent::init();
	     user_error("breakpoint", E_USER_ERROR);
     }
}

