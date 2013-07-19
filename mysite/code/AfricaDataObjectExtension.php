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
		  $title = urlencode($title);
		  $link = $holder->Link().'show/'.$title;
	  }else{
	  	  $id = $this->owner->ID;
		  $link = $holder->Link().'show/'.$id;
		  
	  }
	  
	  return $link;
  }  
  
  public function addCommonFields($fields){
	  	$owner = $this->owner;
	  
	  	if ($owner->ClassName != 'ArtPhoto'){
		  	$gridFieldConfigArtPhotos= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("ArtPhotos", "Art Photos", $owner->ArtPhotos(), $gridFieldConfigArtPhotos);
			$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
			$fields->addFieldToTab('Root.ArtPhotos', new LiteralField('ArtPhotosViewerHeader', '<h2>All Art Photos Listed Below</h2>'));
			$gridFieldConfigArtPhotosViewer= GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("ArtPhotosViewer", null, ArtPhoto::get(), $gridFieldConfigArtPhotosViewer);
			$fields->addFieldToTab('Root.ArtPhotos', $gridfield);
		}
		
		if($owner->ClassName != 'AudioPiece'){
			$gridFieldConfigAudioPieces= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("AudioPieces", "Audio Pieces", $owner->AudioPieces(), $gridFieldConfigAudioPieces);
			$fields->addFieldToTab('Root.AudioPieces', $gridfield);
			$fields->addFieldToTab('Root.AudioPieces', new LiteralField('AudioPieceViewerHeader', '<h2>All Audio Pieces Listed Below</h2>'));
			$gridFieldConfigAudioPiecesViewer= GridFieldConfig_Base ::create(); 
			$gridfieldViewer = new GridField("AudioPiecesViewer", null, AudioPiece::get(), $gridFieldConfigAudioPiecesViewer);
			$fields->addFieldToTab('Root.AudioPieces', $gridfieldViewer);
		}
		
		if($owner->ClassName != 'Country'){

			$gridFieldConfigCountries = GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("Countries", "Countries", $owner->Countries(), $gridFieldConfigCountries);	
			$fields->addFieldToTab('Root.Countries', $gridfield);
			$fields->addFieldToTab('Root.Countries', new LiteralField('CountryViewerHeader', '<h2>All Available Countries Listed Below</h2>'));
			$gridFieldConfigCountriesViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("CountriesViewer", null, Country::get(), $gridFieldConfigCountriesViewer);	
			$fields->addFieldToTab('Root.Countries', $gridfield);
		}

		if($owner->ClassName != 'Essay'){
			$gridFieldConfigEssays = GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("Essays", "Essays", $owner->Essays(), $gridFieldConfigEssays);		
			$fields->addFieldToTab('Root.Essays', $gridfield);
			$fields->addFieldToTab('Root.Essays', new LiteralField('EssayViewerHeader', '<h2>All Essays Listed Below</h2>'));
			$gridFieldConfigEssaysViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("EssaysViewer", null, Essay::get(), $gridFieldConfigEssaysViewer);		
			$fields->addFieldToTab('Root.Essays', $gridfield);
		}
		
		if($owner->ClassName != 'FieldPhoto'){
			$gridFieldConfigFieldPhotos= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("FieldPhotos", "Field Photos", $owner->FieldPhotos(), $gridFieldConfigFieldPhotos);
			$fields->addFieldToTab('Root.FieldPhotos', $gridfield);
			$fields->addFieldToTab('Root.FieldPhotos', new LiteralField('FieldPhotoViewerHeader', '<h2>All Field Photos Listed Below</h2>'));
			$gridFieldConfigFieldPhotosViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("FieldPhotosViewer", null, FieldPhoto::get(), $gridFieldConfigFieldPhotosViewer);
			$fields->addFieldToTab('Root.FieldPhotos', $gridfield);
		}
		if($owner->ClassName != 'People'){
			$gridFieldConfigPeople = GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("People", "People", $owner->People(), $gridFieldConfigPeople);
			$fields->addFieldToTab('Root.People', $gridfield);
			$fields->addFieldToTab('Root.People', new LiteralField('PeopleViewerHeader', '<h2>All Peoples Listed Below</h2>'));
			$gridFieldConfigPeopleViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("PeopleViewer", null, People::get(), $gridFieldConfigPeopleViewer);
			$fields->addFieldToTab('Root.People', $gridfield);
		}
		
		if($owner->ClassName != 'VideoPiece'){
			$gridFieldConfigVideoPieces= GridFieldConfig_RelationEditor::create(); 
			$gridfield = new GridField("VideoPieces", "Video Pieces", $owner->VideoPieces(), $gridFieldConfigVideoPieces);
			$fields->addFieldToTab('Root.VideoPieces', $gridfield);
			$fields->addFieldToTab('Root.VideoPieces', new LiteralField('VideoPieceViewerHeader', '<h2>All Video Pieces Listed Below</h2>'));
			$gridFieldConfigVideoPiecesViewer = GridFieldConfig_Base ::create(); 
			$gridfield = new GridField("VideoPiecesViewer", null, VideoPiece::get(), $gridFieldConfigVideoPiecesViewer);
			$fields->addFieldToTab('Root.VideoPieces', $gridfield);
		}
		
		return $fields;
	  
	  
  }
  
}


