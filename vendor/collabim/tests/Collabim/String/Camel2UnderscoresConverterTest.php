<?php

namespace Collabim\String;

class Camel2UnderscoresConverterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Camel2UnderscoresConverter
	 */
	private $camel2UnderscoresConverter;

	public function setUp() {
		$this->camel2UnderscoresConverter = new Camel2UnderscoresConverter();
	}

	public function testConvert_className() {
		$result = $this->camel2UnderscoresConverter->convert('SomeCamelCase123Name');

		$this->assertSame('some_camel_case_123_name', $result);
	}

	public function testConvert_variableName() {
		$result = $this->camel2UnderscoresConverter->convert('someCamelCaseName123');

		$this->assertSame('some_camel_case_name_123', $result);
	}

}