<?php
 
class AfricaDataObjectExtension extends DataExtension {
 
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
    
  public function Holder(){
  	  $holderClass = $this->owner->ClassName;
	  $holderClass = $holderClass.'Holder';
	  $holder = DataObject::get_one($holderClass);
	  if($holder){
	  	return $holder;
	  }else{
		  return false;
	  }
  }
    
  public function Link($use_id = false){
  
	  $holder = $this->Holder();
	  if($use_id == false){
		  $title = $this->owner->Title;
		  $title = str_replace(' ', '+', $title);
		  $link = $holder->Link().'show/'.$title;
	  }else{
	  	  $id = $this->owner->ID;
		  $link = $holder->Link().'show/'.$id;
		  
	  }
	  
	  
	  
	  return $link;
  }  
  
}


