<?php

namespace Collabim\Claass;

class NameParserTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var NameParser
	 */
	private $classNameParser;

	public function setUp() {
		$this->classNameParser = new NameParser();
	}

	public function testGetClassWithoutNamespace_basic() {
		$result = $this->classNameParser->getClassWithoutNamespace('\Foo\Bar\Bum');

		$this->assertSame('Bum', $result);
	}

	public function testGetClassWithoutNamespace_noNamespace() {
		$result = $this->classNameParser->getClassWithoutNamespace('Bum');

		$this->assertSame('Bum', $result);
	}

	public function testGetNamespace_basic() {
		$result = $this->classNameParser->getNamespace('\Foo\Bar\Bum');

		$this->assertSame('\Foo\Bar', $result);
	}

	public function testGetNamespace_noNamespace() {
		$result = $this->classNameParser->getNamespace('Bum');

		$this->assertNull($result);
	}
}