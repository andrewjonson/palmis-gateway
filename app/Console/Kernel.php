<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\ModelMakeCommand',
        'App\Console\Commands\PermissionSeederMakeCommand',
        'App\Console\Commands\ControllerMakeCommand',
        'App\Console\Commands\RepositoryMakeCommand',
        'App\Console\Commands\InterfaceMakeCommand',
        'App\Console\Commands\ResourceMakeCommand',
        'App\Console\Commands\RequestMakeCommand',
        'App\Console\Commands\LangMakeCommand',
        'App\Console\Commands\MigrationMakeCommand'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
