<?php

namespace CULabs\IlluminateBundle;

use CULabs\IlluminateBundle\Bridge\Container\BridgeContainerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Console\Application;
use CULabs\IlluminateBundle\Bridge\Console\Application as BridgeApplication;

class CULabsIlluminateBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new BridgeContainerPass());
    }

    public function registerCommands(Application $application)
    {
        if (!defined('ARTISAN_BINARY')) {
            define('ARTISAN_BINARY', $this->container->getParameter('kernel.root_dir').'/console');
        }
        parent::registerCommands($application);
        $app = $this->container->get('cu_labs_illuminate.container');
        $bridgeApplication = new BridgeApplication($app, $app['events'], 'laravel', $application);
        $app['events']->fire('artisan.start', [$bridgeApplication]);
    }
}
