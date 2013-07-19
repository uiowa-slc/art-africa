<?php
 
class AfricaDataObject extends DataObject {
 
  
  private static $db = array(	


  );
 
  public function SplitKeywords(){
	    $keywords = $this->Tags;
	    
	    if($keywords){
		   $splitKeywords = explode(',', $keywords); 
	    }
	    
	    if($splitKeywords){
			$keywordsList = new ArrayList(); 
			foreach($splitKeywords as $data) { 
				$do=new DataObject(); 
				$do->Keyword = $data; 
				$keywordsList->push($do); 
			} 
			return $keywordsList; 
			}
    }
  public function Link(){
	  $holderClass = $this->holderClass;
	  $holder = DataObject::get_one($holderClass);
	  
	  $title = $this->Title;
	  $title = urlencode($title);
	  $link = $holder->Link().'show/'.$title;
	  
	  return $link;
  }  
  
}


