<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class SeederMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

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
        $stub = '../../stubs/seeder.stub';

        return __DIR__ . $stub;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $modelClass = Str::replaceArray('App', [''], $name);
        return $this->laravel->basePath('database').'/seeders/'.config('app.version').'/'.Str::lower($modelClass).'.php';
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
        $name = Str::replaceArray('/', ['\\'], $this->argument('name'));
        $seeder = Str::replaceArray('\\'.class_basename($name), [''], $name);
        $baseName = Str::replaceArray('PermissionsTableSeeder', [''], class_basename($name));

        return array_merge($replace, [
            'DummyAppVersion' => config('app.version'),
            'DummySeederNamespace' => $seeder,
            'DummyNameLower' => Str::lower($baseName)
        ]);
    }
}
