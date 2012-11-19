<?php

namespace Acme\HelloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TestPostForm extends AbstractType
{
	public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
	{
		$builder->add('note', 'text', array(
			'label' => 'Some custom label' // NOTE: we should NOT set label here for the HTML coder/designer to be able to change it
		));

		$builder->add('dueDate', 'date');

		$builder->add('trueFalse', new \Symfony\Component\Form\Extension\Core\Type\CheckboxType());

		$builder->add('chooseItem', new \Symfony\Component\Form\Extension\Core\Type\ChoiceType(), array(
			'choices' => array(
				1 => 'Jirka',
				2 => 'Pepa'
			)
		));

		$builder->add('email', new \Symfony\Component\Form\Extension\Core\Type\EmailType());
	}

	public function getName()
	{
		return 'testPost';
	}
}