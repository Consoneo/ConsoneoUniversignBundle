<?php

namespace Consoneo\Bundle\UniversignBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Created by Gabriel Poret <gporet@consoneo.com>
 * Copyright: Consoneo
 */
class Configuration implements ConfigurationInterface
{

	/**
	 * @return TreeBuilder
	 * @throws \RuntimeException
	 */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('consoneo_universign');

		$rootNode
			->children()
                ->arrayNode('horodatage')
					->children()
						->scalarNode('login')
							->cannotBeEmpty()
							->isRequired()
						->end()
						->scalarNode('password')
							->cannotBeEmpty()
							->isRequired()
						->end()
					->end()
                ->end()
			->end()
		->end();
        return $treeBuilder;
    }
}
