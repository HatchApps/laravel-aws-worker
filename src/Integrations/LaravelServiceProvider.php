<?php

namespace Dusterio\AwsWorker\Integrations;

use Illuminate\Support\ServiceProvider;

/**
 * Class CustomQueueServiceProvider
 * @package App\Providers
 */
class LaravelServiceProvider extends ServiceProvider
{
    use BindsWorker;

    /**
     * @return void
     */
    public function register()
    {
        if (function_exists('env') && ! env('REGISTER_WORKER_ROUTES', true)) return;

        $this->bindWorker();
        $this->addRoutes();
    }

    /**
     * @return void
     */
    protected function addRoutes()
    {
        $this->app['router']->post('/worker/schedule', 'Dusterio\AwsWorker\Controllers\WorkerController@schedule');
        $this->app['router']->post('/worker/queue', 'Dusterio\AwsWorker\Controllers\WorkerController@queue');
    }
}
