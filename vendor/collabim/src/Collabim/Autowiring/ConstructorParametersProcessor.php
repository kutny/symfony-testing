<?php

namespace Collabim\Autowiring;

use Symfony\Component\DependencyInjection\Definition;

class ConstructorParametersProcessor
{
	private $parameterProcessor;

	public function __construct(ParameterProcessor $parameterProcessor) {
		$this->parameterProcessor = $parameterProcessor;
	}

	public function processContructorParams(\ReflectionMethod $constructor, Definition $definition, array $classes) {
		$explicitlyDefinedArguments = $definition->getArguments();
		$allArguments = array();

		foreach ($constructor->getParameters() as $index => $parameter) {
			if (array_key_exists($index, $explicitlyDefinedArguments)) {
				$allArguments[] = $explicitlyDefinedArguments[$index];
			}
			else {
				$allArguments[] = $this->parameterProcessor->getParameterValue($parameter, $classes);
			}
		}

		$definition->setArguments($allArguments);
	}

}