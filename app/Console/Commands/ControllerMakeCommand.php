<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends \Illuminate\Console\GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = null;

        if ($this->option('full')) {
            $stub = '../../stubs/controller.stub';
        }

        if ($this->option('jsonresource')) {
            $this->createJsonResource();
        }

        $stub = isset($stub) ? $stub : '../../stubs/controller.plain.stub';

        return __DIR__.$stub;
    }

    protected function createJsonResource()
    {
        $name = Str::replaceArray('Controller', [''], $this->argument('name'));

        $this->call('make:resource', array_filter([
            'name'  => "{$name}Resource"
        ]));
    }

    protected function createFormRequest()
    {
        $name = Str::replaceArray('Controller', [''], $this->argument('name'));

        $this->call('make:request', array_filter([
            'name'  => "{$name}Request"
        ]));
    }

    protected function createLang()
    {
        $name = Str::replaceArray('Controller', [''], $this->argument('name'));

        $this->call('make:lang', array_filter([
            'name'  => lcfirst("{$name}")
        ]));
    }

    protected function createRepositoryInterface()
    {
        $name = Str::replaceArray('Controller', [''], $this->argument('name'));

        $this->call('make:repository', array_filter([
            'name'  => "{$name}Repository"
        ]));

        $this->call('make:interface', array_filter([
            'name'  => "{$name}RepositoryInterface"
        ]));
    }

    protected function createModel()
    {
        $name = Str::replaceArray('Controller', [''], $this->argument('name'));

        $this->call('make:model', array_filter([
            'name'  => "{$name}"
        ]));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers\\'.config('app.version');
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
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('full')) {
            $replace = $this->buildModelReplacements($replace);
        }

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

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
        $modelClass = Str::replaceArray('Controller', [''], $modelClass);
        $langClass = Str::replaceArray('\\', ['/'], $this->argument('name'));
        $langClass = Str::replaceArray('Controller', [''], $langClass);

        return array_merge($replace, [
            'DummyAppVersion' => config('app.version'),
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
            'DummyLangFullPath' => Str::lower($langClass),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        if (! Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace.$model;
        }

        return $model;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['full', null, InputOption::VALUE_NONE, 'Generate a full controller class.'],
            ['jsonresource', null, InputOption::VALUE_NONE, 'Generate a json resource class.'],
        ];
    }
}
