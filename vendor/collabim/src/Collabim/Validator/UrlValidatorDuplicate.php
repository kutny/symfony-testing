<?php
namespace Collabim\Validator;

class UrlValidatorDuplicate implements \Collabim\IValidator {

	public function isValid($value) {
		if (empty($value)) {
			return false;
		}

		$chars = "-\w\d\x80-\xFF";
		$ipAddress = '[\\d]+\\.[\\d]+\\.[\\d]+\\.[\\d]+';

		$pattern = "~^https?://(([$chars]+\\.)+[$chars]{2,}|$ipAddress)(:[\d]+)?(/\S*)?$~i";
		return preg_match($pattern, $value) == 1;
	}

	public function someOtherFunction() {
		return true;
	}
}