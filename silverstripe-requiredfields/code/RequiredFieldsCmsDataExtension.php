<?php
class RequiredFieldsCmsDataExtension extends DataExtension {

	static $enable_serverside = false;

	/**
	* Enable PHP asterisk appending
	*/
	static function enable_serverside() {
		self::$enable_serverside = true;
	}

	static function get_serverside() {
		return self::$enable_serverside;
	}


	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$this->extend('updateCMSFields', $fields);
		return $fields;
	}

	public function updateCMSFields(FieldList $fields) {
		$owner = $this->owner;
		if (!method_exists($owner,'getCMSValidator')) {
			return;
		}
		$validator_fields = $owner->getCMSValidator()->getRequired();
		foreach ($validator_fields as $validator_field) {
			$field = $fields->dataFieldByName($validator_field);
			$field->addExtraClass('required');

			if (self::get_serverside()) {
				$field->setTitle($field->Title() . ' &bull;');	
			} 
		}
	}
}