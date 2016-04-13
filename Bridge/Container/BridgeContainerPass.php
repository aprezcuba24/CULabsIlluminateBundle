<?php

/**
 * @author: Renier Ricardo Figueredo
 * @mail: aprezcuba24@gmail.com
 */
namespace CULabs\IlluminateBundle\Bridge\Container;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class BridgeContainerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('cu_labs_illuminate.container')) {
            return;
        }
        $definition = $container->getDefinition(
            'cu_labs_illuminate.container'
        );
        $taggedServices = $container->findTaggedServiceIds(
            'illuminate.service'
        );
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $alias = null;
                if (isset($attributes['alias'])) {
                    $alias = $attributes['alias'];
                }
                $definition->addMethodCall(
                    'bridgeService',
                    array(new Reference($id), $alias)
                );
            }
        }
    }
}