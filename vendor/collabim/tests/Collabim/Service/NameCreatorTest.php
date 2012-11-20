<?php

namespace Collabim\Service;

class NameCreatorTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var NameCreator
	 */
	private $serviceNameCreator;

	public function setUp() {
		$this->serviceNameCreator = new NameCreator(
			new \Collabim\String\Camel2UnderscoresConverter(),
			array(
				'^Collabim.*' => null,
				'^Model\Facade' => 'facade'
			)
		);
	}

	public function testCreateFromClassName_noNamespace() {
		$result = $this->serviceNameCreator->createFromClassName('UrlDecoder');

		$this->assertSame('url_decoder', $result);
	}

	public function testCreateFromClassName_singleLevelNamespace() {
		$result = $this->serviceNameCreator->createFromClassName('UrlDecoder', 'Collabim');

		$this->assertSame('url_decoder', $result);
	}

	public function testCreateFromClassName_facade() {
		$result = $this->serviceNameCreator->createFromClassName('WhateverFacade', 'Model\Facade');

		$this->assertSame('facade.whatever_facade', $result);
	}

}