<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class PermissionSeederMakeCommand extends \Illuminate\Console\GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:permission-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new permissions seeder class';

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
        return __DIR__.'../../stubs/permission-seeder.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $modelClass = Str::replaceArray('App', [''], $this->argument('name'));
        return $this->laravel->basePath('database').'/seeders/'.$modelClass.'.php';
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

        $replace = $this->buildReplacements($replace);

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
    protected function buildReplacements(array $replace)
    {
        $name = Str::replaceArray('/', ['\\'], $this->argument('name'));
        $seeder = Str::replaceArray('\\'.class_basename($name), [''], $name);

        return array_merge($replace, [
            'DummySeederNamespace' => $seeder,
        ]);
    }
}
