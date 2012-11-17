<?php
namespace Acme\HelloBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service = "controller.hello2")
 */
class Hello2Controller
{
	private $twigEngine;

	public function __construct(\Symfony\Bundle\TwigBundle\TwigEngine $twigEngine) {
		$this->twigEngine = $twigEngine;
	}

	/**
	 * @Route("/hello2/{name}")
	 */
	public function indexAction($name)
	{
		return $this->twigEngine->renderResponse(
			'AcmeHelloBundle:Hello2:index.html.twig',
			array(
				'name' => $name,
				'myVariable' => 'Jirka'
			)
		);
	}

}