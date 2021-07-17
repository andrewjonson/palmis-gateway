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
            ['repository', null, InputOption::VALUE_NONE, 'Create a new repository for the model'],
            ['fillable', null, InputOption::VALUE_NONE, 'Create a model fillables'],
            ['table', null, InputOption::VALUE_NONE, 'Create a model table'],
        ];
    }

    protected function getFillable()
    {
        $fillable = $this->option('fillable');

        if (!is_null($fillable)) {
            $arrays = explode(',', $fillable);

            return json_encode($arrays);
        }

        return '[]';
    }

    protected function getTable()
    {
        $table = $this->option('table');
        $this->call('make:migration', array_filter([
            'name'  => "create_{$table}"
        ]));
        return $table;
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
        return array_merge($replace, [
            'DummyFillables' => $this->getFillable(),
            'DummyTable' => $this->getTable()
        ]);
    }
}
