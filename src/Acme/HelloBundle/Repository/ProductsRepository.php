<?php

namespace Acme\HelloBundle\Repository;

class ProductsRepository
{
	const ENTITY_NAME = 'AcmeHelloBundle:Product';

	private $entityManager;

	public function __construct(\Doctrine\ORM\EntityManager $entityManager) {
		$this->entityManager = $entityManager;
	}

	/**
	 * @return \Acme\HelloBundle\Entity\Product[]
	 */
	public function getProducts() {
		$query = $this->entityManager->createQueryBuilder()
			->select('p')
			->from(self::ENTITY_NAME, 'p')
			->where('p.id = :id')
			->setParameter('id', 1)
			->getQuery();

		return $query->getResult();
	}

}