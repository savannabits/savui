<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class RepoMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository class';

    protected  $type = "Repository";

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return __DIR__ . "/stubs/repo.stub";
    }
    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace."\Repos";
    }
}
