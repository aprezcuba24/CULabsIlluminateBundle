<?php

namespace CULabs\IlluminateBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Console\Application;
use CULabs\IlluminateBundle\Bridge\Console\Application as BridgeApplication;

if (!defined('ARTISAN_BINARY')) {
    define('ARTISAN_BINARY', 'app/console');
}

class CULabsIlluminateBundle extends Bundle
{
    public function registerCommands(Application $application)
    {
        parent::registerCommands($application);
        $app = $this->container->get('cu_labs_illuminate.container');
        $bridgeApplication = new BridgeApplication($app, $app['events'], 'laravel', $application);
        $app['events']->fire('artisan.start', [$bridgeApplication]);
    }
}
