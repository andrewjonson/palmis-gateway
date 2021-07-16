<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ApiServiceMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:api-service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new api service';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = '../../stubs/api-service.stub';

        return __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Services\\ApiService\\'.config('app.version');
    }
}
