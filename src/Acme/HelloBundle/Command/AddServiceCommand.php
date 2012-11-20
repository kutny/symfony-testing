<?php
namespace Acme\HelloBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddServiceCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('add-service')
			->setDescription('Add service to services.yml')
			->addArgument(
				'className',
				InputOption::VALUE_REQUIRED,
				'Full class name to create the service from'
			);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$name = $input->getArgument('className');

		$namespace2ServiceBase = array(
			'^Acme\HelloBundle\Repository' => 'repository',
			'^Acme\HelloBundle\Facade' => 'facade',
			'^Collabim.*' => null,
		);

		$pathToServiceConfig = $this->getContainer()->getParameter('kernel.root_dir') . '/config/services.yml';

		$serviceConfigurationCreator = new \Collabim\ServiceConfigurationCreator(
			$pathToServiceConfig,
			new \Collabim\Claass\NameParser(),
			new \Collabim\Service\NameCreator(
				new \Collabim\String\Camel2UnderscoresConverter(),
				$namespace2ServiceBase
			),
			new \Collabim\Yml\YmlSorter(),
			new \Collabim\Service\DefinitionExistenceChecker()
		);

		$serviceConfigurationCreator->createService($name, $output);
	}
}