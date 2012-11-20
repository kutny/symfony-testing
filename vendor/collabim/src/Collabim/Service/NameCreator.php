<?php

namespace Collabim\Service;

class NameCreator
{
	private $camel2UnderscoresConverter;
	private $namespace2ServiceBase;

	public function __construct(\Collabim\String\Camel2UnderscoresConverter $camel2UnderscoresConverter, array $namespace2ServiceBase) {
		$this->camel2UnderscoresConverter = $camel2UnderscoresConverter;
		$this->namespace2ServiceBase = $namespace2ServiceBase;
	}

	public function createFromClassName($className, $namespace = null) {
		if ($namespace) {
			$serviceBase = $this->convertNamespace2ServiceBase($namespace);

			if ($serviceBase) {
				$serviceName = $serviceBase . '.' . $this->camel2UnderscoresConverter->convert($className);
			}
			else {
				$serviceName = $this->camel2UnderscoresConverter->convert($className);
			}
		}
		else {
			$serviceName = $this->camel2UnderscoresConverter->convert($className);
		}

		return $serviceName;
	}

	private function convertNamespace2ServiceBase($namespace) {
		if (!$namespace) {
			throw new \Exception('Namespace not set');
		}

		foreach ($this->namespace2ServiceBase as $classPattern => $serviceBase) {
			$regexp = '~' . str_replace('\\', '\\\\',  $classPattern) . '~';

			if (preg_match($regexp, $namespace)) {
				return $serviceBase;
			}
		}

		throw new \Exception('Service base not defined for namespace: ' . $namespace);
	}
}
