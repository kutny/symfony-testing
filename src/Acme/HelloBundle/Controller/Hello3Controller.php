<?php
namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class Hello3Controller extends Controller
{
	public function indexAction($name)
	{
		/** @var $pokus \Collabim\Pokus */
		$pokus = $this->get('pokus');

		return $this->render(
			'AcmeHelloBundle:Hello3:index.html.twig',
			array(
				'name' => $name,
				'myVariable' => 'Jirka: ' . $pokus->run()
			)
		);
	}

}