<?php
namespace Acme\HelloBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SortServicesCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('sort-services')
			->setDescription('Sort services in services.yml');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$pathToServiceConfig = $this->getContainer()->getParameter('kernel.root_dir') . '/config/services.yml';
		$ymlSorter = new \Collabim\Yml\YmlSorter();

		$ymlData = file_get_contents($pathToServiceConfig);

		$ymlData = $ymlSorter->sort($ymlData);

		file_put_contents($pathToServiceConfig, $ymlData);
	}

}