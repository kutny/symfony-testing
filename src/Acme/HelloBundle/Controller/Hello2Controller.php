<?php
namespace Acme\HelloBundle\Controller;

use JMS\DiExtraBundle\Annotation\Inject;

class Hello2Controller
{
	/**
	 * @var \Symfony\Bundle\TwigBundle\TwigEngine
	 * @Inject
	 */
	private $templating;

	/**
	 * @Inject
	 */
	private $kernel;

	public function indexAction($name)
	{
		return $this->templating->renderResponse(
			'AcmeHelloBundle:Hello2:index.html.twig',
			array(
				'name' => $name,
				'myVariable' => 'Jirka ' . $this->kernel->getRootDir()
			)
		);
	}

}