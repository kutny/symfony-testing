<?php

namespace Collabim;

class ServiceConfigurationCreator
{
	private $pathToServiceConfig;
	private $classNameParser;
	private $serviceNameCreator;
	private $ymlSorter;
	private $serviceDefinitionExistenceChecker;

	public function __construct(
		$pathToServiceConfig,
		\Collabim\Claass\NameParser $classNameParser,
		\Collabim\Service\NameCreator $serviceNameCreator,
		\Collabim\Yml\YmlSorter $ymlSorter,
		\Collabim\Service\DefinitionExistenceChecker $serviceDefinitionExistenceChecker
	) {
		$this->pathToServiceConfig = $pathToServiceConfig;
		$this->classNameParser = $classNameParser;
		$this->serviceNameCreator = $serviceNameCreator;
		$this->ymlSorter = $ymlSorter;
		$this->serviceDefinitionExistenceChecker = $serviceDefinitionExistenceChecker;
	}

	public function createService($fullClassName, \Symfony\Component\Console\Output\OutputInterface $output) {
		$className = $this->classNameParser->getClassWithoutNamespace($fullClassName);
		$namespace = $this->classNameParser->getNamespace($fullClassName);

		$serviceName = $this->serviceNameCreator->createFromClassName($className, $namespace);

		$ymlData = file_get_contents($this->pathToServiceConfig);

		$ymlData = $this->updateServiceConfiguration($fullClassName, $serviceName, $ymlData, $output);

		file_put_contents($this->pathToServiceConfig, $ymlData);
	}

	private function updateServiceConfiguration($fullClassName, $serviceName, $ymlData, \Symfony\Component\Console\Output\OutputInterface $output) {
		if (!$this->serviceDefinitionExistenceChecker->serviceDefinedInYml($serviceName, $ymlData)) {
			$ymlData = $this->addServiceToYml($serviceName, $fullClassName, $ymlData);

			$ymlData = $this->ymlSorter->sort($ymlData);

			$output->writeln('<info>Service added: ' . $serviceName . '</info>');
		}
		else {
			$output->writeln('<error>Service already defined: ' . $serviceName . '</error>');
		}

		return $ymlData;
	}

	private function addServiceToYml($serviceName, $fullClassName, $ymlData) {
		$ymlData .= "\n" . '  ' . $serviceName . ':'. "\n" . '    ' . 'class: ' . $fullClassName . "\n";

		return $ymlData;
	}

}
