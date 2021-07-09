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
            $this->createPermissionsSeeder();
            $this->createController();
            $this->createRepositoryInterface();
        }
    }

    /**
     * Create a seeder file for the model.
     *
     * @return void
     */
    protected function createPermissionsSeeder()
    {
        $seeder = Str::studly($this->argument('name'));

        $this->call('make:permission-seed', [
            'name' => "{$seeder}PermissionsTableSeeder",
        ]);
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
            '--jsonresource' => $modelName,
            '--formrequest' => $modelName,
            '--lang' => $modelName
        ]));
    }

    protected function createRepositoryInterface()
    {
        $repository = Str::studly($this->argument('name'));

        $this->call('make:repository', array_filter([
            'name'  => "{$repository}Repository"
        ]));

        $this->call('make:interface', array_filter([
            'name'  => "{$repository}RepositoryInterface"
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
        return is_dir($this->laravel->basePath('app/Models'))
            ? $rootNamespace.'\\Models'
            : $rootNamespace;
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
            ['repository', null, InputOption::VALUE_NONE, 'Create a new repository for the model'],
            ['permissionsseed', null, InputOption::VALUE_NONE, 'Create a new seeder file for the model'],
        ];
    }
}
