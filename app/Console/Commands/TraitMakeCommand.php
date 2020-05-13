<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class TraitMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:trait';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a trait';

    protected  $type = "Trait";

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__ . "/stubs/trait.stub";
    }
    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace."\Traits";
    }
}
