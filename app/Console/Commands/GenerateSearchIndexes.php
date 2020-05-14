<?php

namespace App\Console\Commands;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Console\Command;

class GenerateSearchIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Search Indices';
    private $models = [
        Role::class,
        Permission::class,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->alert("Starting Indexing Process");
        foreach ($this->models as $model) {
            $this->info("***********************************************************************");
            $this->comment("Indexing $model");
            $this->info(">---------------------------<");
            $this->call("scout:import", ["model" => $model]);
        }
        $this->info("***********************************************************************");
        $this->alert("INDEXING DONE.");
        return true;
    }
}
