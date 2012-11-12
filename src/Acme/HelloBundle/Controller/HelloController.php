<?php
namespace Acme\HelloBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;

/**
 * @Service("some.service.id", public=false)
 * @Route(service = "acme_hello.hello")
 */
class HelloController
{
	private $twigEngine;

	/**
	 * @InjectParams({
	 *     "twigEngine" = @Inject("templating")
	 * })
	 */
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