<?php
 
class AssetAdminExtension extends DataExtension {
 
 	public function updateEditForm($form){
 	
	 	$gridField = $form->Fields()->dataFieldByName('File');
	 	$oldDataList = $gridField->getList();
	 	$newDataList = $oldDataList->sort('Title');
	 	$gridField->setList($newDataList);
			 	 	
	}
    
}


