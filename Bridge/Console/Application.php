<?php

/**
 * @author: Renier Ricardo Figueredo
 * @mail: aprezcuba24@gmail.com
 */
namespace CULabs\IlluminateBundle\Bridge\Console;

use Illuminate\Console\Application as BaseApplication;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Application as SymfonyApplication;

class Application extends BaseApplication
{
    protected $application;

    public function __construct(Container $laravel, Dispatcher $events, $version, SymfonyApplication $application)
    {
        $this->application = $application;
        parent::__construct($laravel, $events, $version);
    }

    protected function addToParent(SymfonyCommand $command)
    {
        $this->application->add($command);
    }
}