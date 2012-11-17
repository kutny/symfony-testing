<?php
namespace Acme\HelloBundle\Controller;

class Hello2Controller
{
	private $twigEngine;

	public function __construct(\Symfony\Bundle\TwigBundle\TwigEngine $twigEngine) {
		$this->twigEngine = $twigEngine;
	}

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