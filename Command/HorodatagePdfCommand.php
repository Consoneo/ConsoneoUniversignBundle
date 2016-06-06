<?php

namespace Consoneo\Bundle\UniversignBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem as LocalFileSystem;

/**
 * Created by Gabriel Poret <gporet@consoneo.com>
 * Copyright: Consoneo
 */
class HorodatagePdfCommand extends ContainerAwareCommand
{
    /**
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('universign:horodatage-pdf')
            ->addArgument('localPath', InputArgument::REQUIRED, 'file path to timestamp')
            ->addArgument('targetPath', InputArgument::REQUIRED, 'path to save timestamped file')
            ->setDescription('Command for timestamp PDF file')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \LogicException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileSystem = new LocalFileSystem();
        $localPath  = realpath($input->getArgument('localPath'));
        $content = file_get_contents($localPath);

        if ($fileSystem->exists($localPath)) {
            $targetPath = realpath($input->getArgument('targetPath'));
            file_put_contents($targetPath, $this->getContainer()->get('universign.horodatage')->postPdf($content));
        }
    }
}
