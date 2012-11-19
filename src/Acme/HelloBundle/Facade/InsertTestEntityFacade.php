<?php

namespace Acme\HelloBundle\Facade;

class InsertTestEntityFacade
{
	private $entityManager;

	public function __construct(\Doctrine\ORM\EntityManager $entityManager) {
		$this->entityManager = $entityManager;
	}

	public function saveTestEntity(\Acme\HelloBundle\Entity\TestEntity $testEntity) {
		$this->entityManager->persist($testEntity);
		$this->entityManager->flush();
	}

}