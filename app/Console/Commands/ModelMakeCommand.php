<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

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

        if ($this->option('all')) {
            $this->createController();
            $this->createRepository();
        }
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly($this->argument('name'));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:controller', array_filter([
            'name'  => "{$controller}Controller",
            '--full' => $modelName,
            '--jsonresource' => $modelName
        ]));
    }

    protected function createRepository()
    {
        $repository = Str::studly($this->argument('name'));

        $this->call('make:repository', array_filter([
            'name'  => "{$repository}Repository"
        ]));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('all')) {
            $stub = '../../stubs/model.stub';
        } else {
            $stub = '../../stubs/model-plain.stub';
        }

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
        return $rootNamespace.'\\Models\\'.config('app.version');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, and resource controller for the model'],
            ['plain', null, InputOption::VALUE_NONE, 'Create a plain model class'],
            ['controller', null, InputOption::VALUE_NONE, 'Create a new controller for the model'],
            ['repository', null, InputOption::VALUE_NONE, 'Create a new repository for the model']
        ];
    }
}
