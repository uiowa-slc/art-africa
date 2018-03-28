<?php
 
class AfricaDataObjectExtension extends DataExtension {

public function RandomImages(){
	if($this->owner->Images()){
		$images = $this->owner->Images()->sort("RAND()");
		return $images;
	}else{
		return false;
	}
}
 
  public function SplitKeywords(){
	    $keywords = $this->owner->Tags;
	    
	    if($keywords){
		   $splitKeywords = explode(',', $keywords); 
	    }
	    
	    if($splitKeywords){
			$keywordsList = new ArrayList(); 
			foreach($splitKeywords as $data) { 
				$do=new DataObject(); 
				$do->Keyword = trim($data); 
				$keywordsList->push($do); 
			} 
			return $keywordsList; 
			}
    }
    
  public function Holder(){
  	  $holderClass = $this->owner->ClassName;
	  $holderClass = $holderClass.'Holder';
	  if(class_exists($holderClass)){
	  	$holder = DataObject::get_one($holderClass);
	  }
	  if(isset($holder)){
	  	return $holder;
	  }else{
		  return false;
	  }
  }
    
  public function Link($use_id = false){
  
	  if($holder = $this->Holder()){
	  //print_r($holder);
	  if($use_id == false){
		  $title = $this->owner->Title;
		  $title = urlencode($title);
		  $link = $holder->Link().'show/'.$title;
	  }else{
	  	  $id = $this->owner->ID;
		  $link = $holder->Link().'show/'.$id;
		  
	  }

	  
	  return $link;
	}
  }
  

	public function ShowMoreLink(){

		$searchBaseURL =  'media/index?';
		$searchMiddle = '';
		$searchAfter = '&MediaType=Image&action_=Use+Filter';

		$ownerClass = $this->owner->ClassName;
		$ownerID = $this->owner->ID;


		$searchMiddle = $ownerClass.'='.$ownerID;

		return $searchBaseURL.$searchMiddle.$searchAfter;

	}


  public function getCreditLine(){
	    
	  $newCreditLineArray = explode('</p>', $this->owner->Caption);

	  $desiredIndex = count($newCreditLineArray) - 2; //This should be the credit line portion of the caption -- the last item of the array is blank based on how the explode works
	  if ($desiredIndex > 0){
	  	$newCreditLine = $newCreditLineArray[$desiredIndex]; //Get credit line
	  	
	  	$newCreditLine = strip_tags($newCreditLine); //Takes out <p> and </p> tags 
	    
	    return $newCreditLine;
	  }
	 
	  return;
  }
  
  public function addCommonFields($fields){
	  	$owner = $this->owner;
	  	//print_r($owner->Images());
	  /*	if (($owner->ClassName != 'ArtImage') && ($owner->ClassName != 'Image')){
		  	$gridFieldConfigArtImages= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("ArtImages", "Art Images", $owner->ArtImages(), $gridFieldConfigArtImages);
			$fields->addFieldToTab('Root.ArtImages', $gridfield);
			$fields->addFieldToTab('Root.ArtImages', new LiteralField('ArtImagesViewerHeader', '<h2>All Art Images Listed Below</h2>'));
			$gridFieldConfigArtImagesViewer= GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("ArtImagesViewer", null, ArtImage::get(), $gridFieldConfigArtImagesViewer);
			$fields->addFieldToTab('Root.ArtImages', $gridfield);
		}*/
		
		if ($owner->ClassName != 'Image'){
		
		  	$gridFieldConfigImages= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("Images", "Images", $owner->Images(), $gridFieldConfigImages);
			$gridFieldConfigImages->addComponent(new GridFieldBulkManager());
			$fields->addFieldToTab('Root.Images', $gridfield);
			
			$fields->addFieldToTab('Root.Images', new LiteralField('ImagesViewerHeader', '<h2>All Images Listed Below</h2>'));
			
			$gridFieldConfigImagesViewer= GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("ImagesViewer", null, Image::get(), $gridFieldConfigImagesViewer);
			$fields->addFieldToTab('Root.Images', $gridfield);
			
			
		}
		
		if(($owner->ClassName != 'Chapter') && ($owner->ClassName != 'Subtopic')){
			$gridFieldConfigChapters = GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("Chapters", "Chapters", $owner->Chapters(), $gridFieldConfigChapters);
			$fields->addFieldToTab('Root.Chapters', $gridfield);
			$fields->addFieldToTab('Root.Chapters', new LiteralField('PeopleViewerHeader', '<h2>All Chapters Listed Below For Reference:</h2>'));
			$gridFieldConfigChaptersViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("ChaptersViewer", null, Chapter::get(), $gridFieldConfigChaptersViewer);
			$fields->addFieldToTab('Root.Chapters', $gridfield);
		}
		
		if($owner->ClassName != 'Country'){

			$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("Countries", "Countries", $owner->Countries(), $gridFieldConfigCountries);	
			$fields->addFieldToTab('Root.Countries', $gridfield);
			$fields->addFieldToTab('Root.Countries', new LiteralField('CountryViewerHeader', '<h2>All Available Countries Listed Below For Reference:</h2>'));
			$gridFieldConfigCountriesViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("CountriesViewer", null, Country::get(), $gridFieldConfigCountriesViewer);	
			$fields->addFieldToTab('Root.Countries', $gridfield);
		}


		if($owner->ClassName != 'People'){
			$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("People", "People", $owner->People(), $gridFieldConfigPeople);
			$fields->addFieldToTab('Root.People', $gridfield);
			$fields->addFieldToTab('Root.People', new LiteralField('PeopleViewerHeader', '<h2>All Peoples Listed Below For Reference:</h2>'));
			$gridFieldConfigPeopleViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("PeopleViewer", null, People::get(), $gridFieldConfigPeopleViewer);
			$fields->addFieldToTab('Root.People', $gridfield);
		}

		if($owner->ClassName != 'Essay'){
			$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("Essays", "Essays", $owner->Essays(), $gridFieldConfigEssays);		
			$fields->addFieldToTab('Root.Essays', $gridfield);
			$fields->addFieldToTab('Root.Essays', new LiteralField('EssayViewerHeader', '<h2>All Essays Listed Below For Reference:</h2>'));
			$gridFieldConfigEssaysViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("EssaysViewer", null, Essay::get(), $gridFieldConfigEssaysViewer);		
			$fields->addFieldToTab('Root.Essays', $gridfield);
		}
		
		if($owner->ClassName != 'VideoPiece'){
			$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("VideoPieces", "Video Pieces", $owner->VideoPieces(), $gridFieldConfigVideoPieces);
			$fields->addFieldToTab('Root.VideoPieces', $gridfield);
			$fields->addFieldToTab('Root.VideoPieces', new LiteralField('VideoPieceViewerHeader', '<h2>All Video Pieces Listed Below For Reference:</h2>'));
			$gridFieldConfigVideoPiecesViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("VideoPiecesViewer", null, VideoPiece::get(), $gridFieldConfigVideoPiecesViewer);
			$fields->addFieldToTab('Root.VideoPieces', $gridfield);
		}

		if($owner->ClassName != 'AudioPiece'){
			$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("AudioPieces", "Audio Pieces", $owner->AudioPieces(), $gridFieldConfigAudioPieces);
			$fields->addFieldToTab('Root.AudioPieces', $gridfield);
			$fields->addFieldToTab('Root.AudioPieces', new LiteralField('AudioPieceViewerHeader', '<h2>All Audio Pieces Listed Below For Reference:</h2>'));
			$gridFieldConfigAudioPiecesViewer= GridFieldConfig_Base ::create(); 
			$gridfieldViewer = new GridField("AudioPiecesViewer", null, AudioPiece::get(), $gridFieldConfigAudioPiecesViewer);
			$fields->addFieldToTab('Root.AudioPieces', $gridfieldViewer);
		}
		
		return $fields;
	  
	  
  }
  
}


