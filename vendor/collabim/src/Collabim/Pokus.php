<?php
namespace Collabim;

class Pokus {

	private $configOption;
	private $pokus22;
	private $pokus2;

	public function __construct($configOption, Pokus2 $pokus22, Pokus2 $pokus2) {
		$this->configOption = $configOption;
		$this->pokus22 = $pokus22;
		$this->pokus2 = $pokus2;
	}

	public function run() {
		return $this->pokus22->sayHello() . ' ' . $this->configOption . ' ' . 42;
	}

}