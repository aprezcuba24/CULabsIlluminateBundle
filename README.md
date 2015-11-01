CULabsIlluminateBundle
==================

Resumen
-------
Este bundle integra la librería Illuminate del framework Laravel en symfony2, permitiendo usar por ahora el componente Queue y Schedule.

Instlación
----------
```json
{
    "require": {
        "culabs/illuminate-bundle": "dev-master"
    }
}
```
Actulizar los vendors
```
php composer.phar update --prefer-dist
```
Adicionar los bundles en ``AppKernel``
```php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new CULabs\IlluminateBundle\CULabsIlluminateBundle(),
        // ...
    );
}
```
Configuración
-------------
Se debe poner los datos de configuración de laravel, para saber el significado de cada parámetro ir a la documentación de Laravel.
```yaml
cu_labs_illuminate:
    app:
        key: varlo32caracteres
    database:
        connections:
            mysql:
                database: %database_name%
                username: %database_user%
                password: %database_password%
    queue:
        default: redis
```
Queue
-----
Crear un ``Job`` como se indica en la documentación de laravel y luego lanzar el job de la siguiente forma.
```php
$job = new SendReminderEmail();
$job->delay(2);
$this->get('bus_dispatcher')->dispatch($job);
```
Schedule
--------
La clase AppKernel debe implementar la interfaz ``CULabs\IlluminateBundle\Bridge\Scheduling\ScheduleKernelInterface`` y hacer el método ``schedule``
Ejemplos de cómo crear los schedule lo puede ver en la documentación de laravel.
```php
use Illuminate\Console\Scheduling\Schedule;

public function schedule(Schedule $schedule)
{
    $schedule->call(function (){
        $this->container->get('some_service')->method();
    })->everyMinute();
}
```