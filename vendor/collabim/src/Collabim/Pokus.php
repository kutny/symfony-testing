<?php
namespace Collabim;

use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;

/**
 * @Service("pokus")
 */
class Pokus {

	private $configOption;
	private $pokus22;
	private $pokus2;

	/**
	 * @InjectParams({
	 *   "configOption" = @Inject("%myTestOption%"),
	 *   "pokus22" = @Inject("pokus2")
	 * })
	 */
	public function __construct($configOption, Pokus2 $pokus22, Pokus2 $pokus2) {
		$this->configOption = $configOption;
		$this->pokus22 = $pokus22;
		$this->pokus2 = $pokus2;
	}

	public function run() {
		return $this->pokus22->sayHello() . ' ' . $this->configOption . ' ' . 42;
	}
}