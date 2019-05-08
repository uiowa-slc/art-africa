<?php

use SilverStripe\Assets\File;
use SilverStripe\ORM\DataExtension;
 
class AssetAdminExtension extends DataExtension {
 
 	public function updateEditForm($form){
 	
	 	$gridField = $form->Fields()->dataFieldByName(File::class);
	 	$oldDataList = $gridField->getList();
	 	$newDataList = $oldDataList->sort('Title');
	 	$gridField->setList($newDataList);
			 	 	
	}
    
}


