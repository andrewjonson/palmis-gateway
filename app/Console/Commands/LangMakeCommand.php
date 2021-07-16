<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class LangMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:lang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new language file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Language';

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
        $stub = '../../stubs/lang.stub';

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
        return $this->laravel->basePath('resources').'/lang/en/'.config('app.version').'/'.Str::lower($modelClass).'.php';
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
        $modelClass = Str::replaceArray('Controller', [''], $modelClass);

        return array_merge($replace, [
            'DummyModelClass' => class_basename($modelClass),
        ]);
    }
}
