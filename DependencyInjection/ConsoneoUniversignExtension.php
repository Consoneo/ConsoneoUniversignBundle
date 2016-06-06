<?php

namespace Consoneo\Bundle\UniversignBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Created by Gabriel Poret <gporet@consoneo.com>
 * Copyright: Consoneo
 */
class ConsoneoUniversignExtension extends Extension
{

	/**
	 * @param array $configs
	 * @param ContainerBuilder $container
	 * @throws \Symfony\Component\DependencyInjection\Exception\BadMethodCallException
	 * @throws \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
	 */
    public function load(array $configs, ContainerBuilder $container)
    {
		$config = $this->processConfiguration($this->getConfiguration($configs, $container), $configs);

		$horodatage = new Definition('Consoneo\Bundle\UniversignBundle\Horodatage', [
			$config['horodatage']['login'],
			$config['horodatage']['password'],
		]);

		if (array_key_exists('debug', $config)) {
			$horodatage->addMethodCall('setLogger', [new Reference('logger')]);
		}

		$horodatage->addMethodCall('setDoctrine', [new Reference('doctrine')]);

		// Add the service to the container
		$container->setDefinition('universign.horodatage', $horodatage);
    }
}
