<?php
 
class CollectionPiece extends Page {
 
  
  public static $db = array(	

	  'ArtistName' => 'Varchar',
	  "Keywords" => "Text"

  );
 
  // One-to-one relationship with gallery page
  public static $has_one = array(
    'Image' => 'Image',
    //'CollectionHolderPage' => 'CollectionHolderPage'	
  );
  
  public static $many_many = array(
  	//"Categories" => "Category"
  );
  
  public static $belongs_many_many = array( 
  	"SubTopics" => "SubTopicPage"
  );
  
	static $create_table_options = array(
	    'MySQLDatabase' => 'ENGINE=MyISAM'
	);
	
	
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
 		$fields = parent::getCMSFields();
		//$fields->removeFieldFromTab("Root.Main","CollectionHolderPageID");
		//$fields->removeFieldFromTab("Root.Main","SortOrder");
		$fields->addFieldToTab("Root.Main", new TextField("Keywords","Keywords"));
		
		$fields->addFieldToTab("Root.Main", new UploadField("Image","Image"));
		
		return $fields;		
  }
  
  // Tell the datagrid what fields to show in the table
   public static $summary_fields = array( 
       'ID' => 'ID',
	   'Title' => 'Title',
	   'ArtistName' => 'Artist',
	   'Thumbnail' => 'Thumbnail'
   );
  
  // this function creates the thumnail for the summary fields to use
   public function getThumbnail() { 
     return $this->Image()->CMSThumbnail();
  }

}
  
 class CollectionPiece_Controller extends Page_Controller{
	 
public function SplitKeywords(){
	    $keywords = $this->Keywords;
	    //print_r($keywords);
	    if($keywords){
		   $splitKeywords = explode(',', $keywords); 
	    }
	    
	    if(isset($splitKeywords)){
			$keywordsList = new ArrayList(); 
			
			foreach($splitKeywords as $data) { 
				$do=new ArrayData(
					Array("Keyword" => $data,
						"Link" => Director::absoluteBaseURL()."/home/SearchForm?Search=".$data."&action_results=L"
					)
				); 
				//$do->Keyword = $data; 
				$keywordsList->add($do); 
			} 
			//print_r($keywordsList);
			return $keywordsList; 
			}
    }
	 
	 
 }
 