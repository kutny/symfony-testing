<?php
namespace Collabim;

use JMS\DiExtraBundle\Annotation\Service;

/**
 * @Service("pokus2")
 */
class Pokus2 {

	public function sayHello() {
		return 'hello';
	}
}