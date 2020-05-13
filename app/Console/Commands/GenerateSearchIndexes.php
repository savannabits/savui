<?php

namespace App\Console\Commands;

use App\Article;
use App\BulkDispatch;
use App\BulkDispatchItem;
use App\BulkRequest;
use App\BulkRequestArticleItem;
use App\BulkRequestRecipeItem;
use App\Depot;
use App\DerivedUnit;
use App\Disposal;
use App\FoodReturn;
use App\Login;
use App\Lpo;
use App\Outlet;
use App\Permission;
use App\ProductDispatch;
use App\ProductDispatchItem;
use App\PurchaseOrder;
use App\Recipe;
use App\Role;
use App\SingleItemDispatch;
use App\SingleItemRequest;
use App\SingleRecipeDispatch;
use App\SingleRecipeDispatchItem;
use App\SingleRecipeRequest;
use App\SingleRecipeRequestItem;
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
