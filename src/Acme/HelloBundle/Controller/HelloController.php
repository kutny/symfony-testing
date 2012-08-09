<?php
namespace Acme\HelloBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service = "acme_hello.hello")
 */
class HelloController
{
	private $twigEngine;

	public function __construct(\Symfony\Bundle\TwigBundle\TwigEngine $twigEngine) {
		$this->twigEngine = $twigEngine;
	}

	/**
	 * @Route("/hello/{name}")
	 */
	public function indexAction($name)
	{
		return $this->twigEngine->renderResponse(
			'AcmeHelloBundle:Hello:index.html.twig',
			array(
				'name' => $name,
				'myVariable' => 'Jirka'
			)
		);
	}

}