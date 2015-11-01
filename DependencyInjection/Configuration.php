<?php

namespace CULabs\IlluminateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cu_labs_illuminate');

        $rootNode
            ->children()
                ->arrayNode('database')
                    ->addDefaultsIfNotSet()
                    ->isRequired()
                    ->children()
                        ->enumNode('default')->values(['mysql', 'sqlite'])->defaultValue('mysql')->end()
                        ->arrayNode('redis')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('cluster')->defaultValue(false)->end()
                                ->arrayNode('default')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('host')->defaultValue('127.0.0.1')->end()
                                        ->scalarNode('port')->defaultValue(6379)->end()
                                        ->scalarNode('database')->defaultValue(0)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('connections')
                            ->addDefaultsIfNotSet()
                            ->isRequired()
                            ->children()
                                ->arrayNode('sqlite')
                                    ->children()
                                        ->scalarNode('driver')->defaultValue('sqlite')->end()
                                        ->scalarNode('driver')->defaultValue('sqlite')->end()
                                        ->scalarNode('prefix')->defaultValue('')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('mysql')
                                    ->addDefaultsIfNotSet()
                                    ->isRequired()
                                    ->children()
                                        ->scalarNode('driver')->defaultValue('mysql')->end()
                                        ->scalarNode('host')->defaultValue('localhost')->end()
                                        ->scalarNode('charset')->defaultValue('utf8')->end()
                                        ->scalarNode('collation')->defaultValue('utf8_unicode_ci')->end()
                                        ->scalarNode('prefix')->defaultValue('')->end()
                                        ->scalarNode('database')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('username')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
                                        ->booleanNode('strict')->defaultValue(false)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('app')
                    ->addDefaultsIfNotSet()
                    ->isRequired()
                    ->children()
                        ->enumNode('cipher')->values(['AES-256-CBC', 'AES-128-CBC'])->defaultValue('AES-256-CBC')->end()
                        ->scalarNode('key')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                    ->validate()
                        ->ifTrue(function ($v) {
                            $length = mb_strlen($v['key'], '8bit');
                            $cipher = $v['cipher'];

                            return ($cipher === 'AES-128-CBC' && $length !== 16) || ($cipher === 'AES-256-CBC' && $length !== 32);
                        })->thenInvalid('The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths. AES-128-CBC: 16 key length and AES-256-CBC: 32 key length.')
                    ->end()
                ->end()
                ->arrayNode('queue')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->enumNode('default')->values(['redis', 'sync'])->defaultValue('sync')->end()
                        ->arrayNode('connections')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('sync')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('driver')->defaultValue('sync')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('redis')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('driver')->defaultValue('redis')->end()
                                        ->scalarNode('connection')->defaultValue('default')->end()
                                        ->scalarNode('queue')->defaultValue('default')->end()
                                        ->scalarNode('expire')->defaultValue('60')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('failed')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('database')->defaultValue('mysql')->end()
                                ->scalarNode('table')->defaultValue('failed_jobs')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
