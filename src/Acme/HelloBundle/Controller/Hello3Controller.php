<?php
namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Hello3Controller extends Controller
{
	/**
	 * @Route("/hello3/{name}")
	 */
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