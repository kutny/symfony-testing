<?php
namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormTestController extends Controller
{
	/**
	 * @Route("/form-test", name="route.formTest")
	 */
	public function indexAction(Request $request)
	{
		$form = $this->prepareForm();

		if ($request->getMethod() === 'POST') {
			$this->saveForm($form, $request);
		}

		return $this->render('AcmeHelloBundle:FormTest:index.html.twig', array(
			'form' => $form->createView()
		));
	}

	private function prepareForm()
	{
		return $this->createForm(new \Acme\HelloBundle\Form\TestPostForm(), array(
			'note' => 'some default note'
		));
	}

	private function saveForm(\Symfony\Component\Form\Form $form, Request $request)
	{
		$form->bind($request);

		if ($form->isValid()) {
			$this->get('session')->setFlash('notice', 'Your changes were saved!');

			$this->redirect($this->generateUrl('route.formTest'));
		}
	}

}