<?php
namespace Acme\HelloBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Acme\HelloBundle\Facade;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route(service = "controller.form_test2")
 */
class FormTest2Controller
{
	private $formFactory;
	private $insertTestEntityFacade;
	private $session;
	private $router;
	private $testPostForm;

	public function __construct(
		FormFactory $formFactory,
		Facade\InsertTestEntityFacade $insertTestEntityFacade,
		Session $session,
		Router $router,
		\Acme\HelloBundle\Form\TestPostForm $testPostForm
	) {
		$this->formFactory = $formFactory;
		$this->insertTestEntityFacade = $insertTestEntityFacade;
		$this->session = $session;
		$this->router = $router;
		$this->testPostForm = $testPostForm;
	}

	/**
	 * @Route("/form-test2", name="route.formTest2")
	 * @Template
	 */
	public function indexAction(Request $request)
	{
		$testEntity = new \Acme\HelloBundle\Entity\TestEntity();

		$form = $this->prepareForm($testEntity);

		if ($request->getMethod() === 'POST') {
			return $this->saveForm($form, $request);
		}
		else {
			return $this->prepareTemplateValues($form);
		}
	}

	private function prepareForm(\Acme\HelloBundle\Entity\TestEntity $testEntity)
	{
		// set form default values
		$testEntity->setNote('some default note');
		$testEntity->setChooseItem(2);

		return $this->formFactory->create($this->testPostForm, $testEntity);
	}

	private function saveForm(\Symfony\Component\Form\Form $form, Request $request)
	{
		$form->bind($request);

		if ($form->isValid()) {
			$this->insertTestEntityFacade->saveTestEntity($form->getData());

			$flashBag = $this->session->getFlashBag();
			$flashBag->add('notice', 'Your changes were saved!');

			return new RedirectResponse($this->router->generate('route.formTest2'), 301);
		}
		else {
			return $this->prepareTemplateValues($form);
		}
	}

	private function prepareTemplateValues(\Symfony\Component\Form\Form $form) {
		return array(
			'heading' => 'Ahoj formuláři<script>alert()</script>',
			'form' => $form->createView()
		);
	}

}