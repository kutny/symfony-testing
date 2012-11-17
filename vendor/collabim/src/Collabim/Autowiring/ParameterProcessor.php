<?php

namespace Collabim\Autowiring;

use Symfony\Component\DependencyInjection\Reference;

class ParameterProcessor
{
	public function getParameterValue(\ReflectionParameter $parameter, array $classes)
	{
		$parameterClass = $parameter->getClass();

		if ($parameterClass)
		{
			$value = $this->processParameterClass($parameterClass, $parameter, $classes);
		}
		else if ($parameter->isDefaultValueAvailable())
		{
			$value = $parameter->getDefaultValue();
		}
		else
		{
			throw new \Exception('Class ' . $parameter->getDeclaringClass()->getName() . ' constructor param $' . $parameter->getName() . ' cannot be resolved');
		}

		return $value;
	}

	private function processParameterClass(\ReflectionClass $parameterClass, \ReflectionParameter $parameter, $classes) {
		$class = $parameterClass->getName();

		if (isset($classes[$class]))
		{
			if (count($classes[$class]) === 1) {
				$value = new Reference($classes[$class][0]);
			}
			else {
				throw new \Exception('Multiple service definition for class ' . $class);
			}
		}
		else if ($parameter->isDefaultValueAvailable())
		{
			$value = $parameter->getDefaultValue();
		}
		else
		{
			throw new \Exception('Service not defined for class ' . $class);
		}

		return $value;
	}
}