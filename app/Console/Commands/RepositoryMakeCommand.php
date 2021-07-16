<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * 
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  base_path('App/Console/stubs/repository.stub');
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories\Eloquent\\'.config('app.version');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $replace = [];

        $replace = $this->buildModelReplacements($replace);

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = Str::replaceArray('/', ['\\'], $this->argument('name'));
        $modelClass = Str::replaceArray('Repository', [''], $modelClass);

        return array_merge($replace, [
            'DummyAppVersion' => env('APP_VERSION'),
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
        ]);
    }
}