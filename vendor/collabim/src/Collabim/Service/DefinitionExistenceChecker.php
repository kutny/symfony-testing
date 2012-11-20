<?php

namespace Collabim\Service;

class DefinitionExistenceChecker
{
	public function serviceDefinedInYml($serviceName, $ymlData) {
		return (strpos($ymlData, ' ' . $serviceName . ':') > 0);
	}
}
