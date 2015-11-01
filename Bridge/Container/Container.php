<?php

/**
 * @author: Renier Ricardo Figueredo
 * @mail: aprezcuba24@gmail.com
 */
namespace CULabs\IlluminateBundle\Bridge\Container;

use CULabs\IlluminateBundle\Bridge\Scheduling\ScheduleKernelInterface;
use Illuminate\Console\ScheduleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Container\Container as BaseContainer;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Encryption\EncryptionServiceProvider;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Redis\RedisServiceProvider;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\KernelInterface;

class Container extends BaseContainer implements ContractApplication
{
    public function __construct(KernelInterface $kernel, $configs)
    {
        $this->instance('config', $config = new Repository());
        $this->alias('queue.connection', \Illuminate\Contracts\Queue\Queue::class);
        foreach ($configs as $key => $item) {
            $config->set($key, $item);
        }
        foreach ($this->servicesProvider() as $class) {
            $provider = new $class($this);
            if (!$provider instanceof ServiceProvider) {
                throw new \InvalidArgumentException(sprintf('The class "%s" is not subclass of "%s".', $class, ServiceProvider::class));
            }
            $this->register($provider);
        }
        $this->registerSchedule($kernel);
    }

    protected function registerSchedule(KernelInterface $kernel)
    {
        if (!$kernel instanceof ScheduleKernelInterface) {
            return;
        }
        $this->instance(
            'Illuminate\Console\Scheduling\Schedule', $schedule = new Schedule()
        );
        $kernel->schedule($schedule);
    }

    protected function servicesProvider()
    {
        return [
            EventServiceProvider::class,
            EncryptionServiceProvider::class,
            DatabaseServiceProvider::class,
            QueueServiceProvider::class,
            BusServiceProvider::class,
            RedisServiceProvider::class,
            ScheduleServiceProvider::class,
        ];
    }
    
    public function register($provider, $options = [], $force = false)
    {
        $provider->register();
        foreach ($options as $key => $value) {
            $this[$key] = $value;
        }
    }

    public function getBusDispatcher()
    {
        return $this->make('Illuminate\Contracts\Bus\Dispatcher');
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        // TODO: Implement version() method.
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @return string
     */
    public function basePath()
    {
        // TODO: Implement basePath() method.
    }

    /**
     * Get or check the current application environment.
     *
     * @param  mixed
     * @return string
     */
    public function environment()
    {
        // TODO: Implement environment() method.
    }

    /**
     * Determine if the application is currently down for maintenance.
     *
     * @return bool
     */
    public function isDownForMaintenance()
    {
        // TODO: Implement isDownForMaintenance() method.
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    public function registerConfiguredProviders()
    {
        // TODO: Implement registerConfiguredProviders() method.
    }

    /**
     * Register a deferred provider and service.
     *
     * @param  string $provider
     * @param  string $service
     * @return void
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        // TODO: Implement registerDeferredProvider() method.
    }

    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: Implement boot() method.
    }

    /**
     * Register a new boot listener.
     *
     * @param  mixed $callback
     * @return void
     */
    public function booting($callback)
    {
        // TODO: Implement booting() method.
    }

    /**
     * Register a new "booted" listener.
     *
     * @param  mixed $callback
     * @return void
     */
    public function booted($callback)
    {
        // TODO: Implement booted() method.
    }

    /**
     * Get the path to the cached "compiled.php" file.
     *
     * @return string
     */
    public function getCachedCompilePath()
    {
        // TODO: Implement getCachedCompilePath() method.
    }

    /**
     * Get the path to the cached services.json file.
     *
     * @return string
     */
    public function getCachedServicesPath()
    {
        // TODO: Implement getCachedServicesPath() method.
    }
}