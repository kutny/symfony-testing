<?php

namespace Collabim\String;

class Camel2UnderscoresConverter
{
	public function convert($string) {
		$string = preg_replace('~([A-Z])~e', "'_' . strtolower('\\1')", $string);

		$string = preg_replace('~([0-9]+)~', '_$1', $string);

		if (substr($string, 0, 1) === '_') {
			return substr($string, 1);
		}

		return $string;
	}
}