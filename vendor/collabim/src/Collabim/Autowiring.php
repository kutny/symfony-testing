<?php

namespace Collabim;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Autowiring extends Bundle
{
    public function build(ContainerBuilder $container)
    {
		$container->addCompilerPass(new \Collabim\Autowiring\AutowiringTestPass(
			new \Collabim\Autowiring\ConstructorParametersProcessor(
				new \Collabim\Autowiring\ParameterProcessor()
			),
			new \Collabim\Autowiring\ClassesPreparer()
		));
    }
}
