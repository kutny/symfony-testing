<?php
// src/Acme/HelloBundle/Controller/HelloController.php
namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HelloController extends Controller
{

	/**
	 * @Route("/hello/{name}")
	 */
	public function indexAction($name)
	{
		return $this->render(
			'AcmeHelloBundle:Hello:index.html.twig',
			array(
				'name' => $name,
				'myVariable' => 'Jirka'
			)
		);
	}

}