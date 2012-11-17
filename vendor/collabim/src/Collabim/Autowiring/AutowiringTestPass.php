<?php

namespace Collabim\Autowiring;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AutowiringTestPass implements CompilerPassInterface
{
	private $constructorParametersProcessor;
	private $classesPreparer;

	public function __construct(ConstructorParametersProcessor $constructorParametersProcessor, ClassesPreparer $classesPreparer) {
		$this->constructorParametersProcessor = $constructorParametersProcessor;
		$this->classesPreparer = $classesPreparer;
	}

	public function process(ContainerBuilder $containerBuilder)
	{
		$classes = $this->classesPreparer->prepareClasses($containerBuilder);

		$servicesForAutoloading = $this->getServicesForAutoloading($containerBuilder);
		$parameterBag = $containerBuilder->getParameterBag();

		foreach ($containerBuilder->getDefinitions() as $serviceId => $definition) {
			if (!in_array($serviceId, $servicesForAutoloading)) {
				continue;
			}

			if (!$definition->isPublic()) {
				continue;
			}

			$class = $parameterBag->resolveValue($definition->getClass());

			if ($class === null) {
				continue;
			}

			$reflection = new \ReflectionClass($class);
			$constructor = $reflection->getConstructor();

			if ($constructor !== null && $constructor->isPublic()) {
				$this->constructorParametersProcessor->processContructorParams($constructor, $definition, $classes);
			}
		}
	}

	private function getServicesForAutoloading(ContainerBuilder $containerBuilder) {
		$data = file_get_contents($containerBuilder->getParameter('kernel.root_dir') . '/config/services.yml');

		$servicesConfigData = \Symfony\Component\Yaml\Yaml::parse($data);

		return array_keys($servicesConfigData['services']);
	}

}