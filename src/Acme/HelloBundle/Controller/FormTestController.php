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
			return $this->saveForm($form, $request);
		}
		else {
			return $this->renderTemplate($form);
		}
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

			return $this->redirect($this->generateUrl('route.formTest'));
		}
		else {
			return $this->renderTemplate($form);
		}
	}

	private function renderTemplate(\Symfony\Component\Form\Form $form) {
		return $this->render('AcmeHelloBundle:FormTest:index.html.twig', array(
			'form' => $form->createView()
		));
	}

}