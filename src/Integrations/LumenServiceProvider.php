<?php

namespace Dusterio\AwsWorker\Integrations;

use Illuminate\Support\ServiceProvider;

/**
 * Class CustomQueueServiceProvider
 * @package App\Providers
 */
class LumenServiceProvider extends ServiceProvider
{
    use BindsWorker;

    /**
     * @return void
     */
    public function register()
    {
        if (function_exists('env') && ! env('REGISTER_WORKER_ROUTES', true)) return;

        $this->bindWorker();
        $this->addRoutes(isset( $this->app->router ) ? $this->app->router : $this->app );
    }

    /**
     * @param mixed $router
     * @return void
     */
    protected function addRoutes($router)
    {
        $router->post('/worker/schedule', 'Dusterio\AwsWorker\Controllers\WorkerController@schedule');
        $router->post('/worker/queue', 'Dusterio\AwsWorker\Controllers\WorkerController@queue');
    }
}