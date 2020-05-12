<?php namespace Savannabits\WebGenerator;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateAdmin extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'web:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold complete CRUD web interface';

    /**
     * The filesysem object
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $files) {
        $this->files = $files;

        $tableNameArgument = $this->argument('table_name');
        $modelOption = $this->option('model-name');
        $controllerOption = $this->option('controller-name');
        $exportOption = $this->option('with-export');
        $withoutBulkOptions = $this->option('without-bulk');
        $force = $this->option('force');

        $this->call('web:generate:model', [
            'table_name' => $tableNameArgument,
            'class_name' => $modelOption,
            '--force' => $force,
        ]);

        $this->call('web:generate:factory', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--seed' => $this->option('seed'),
        ]);

        $this->call('web:generate:controller', [
            'table_name' => $tableNameArgument,
            'class_name' => $controllerOption,
            '--model-name' => $modelOption,
            '--force' => $force,
            '--with-export' => $exportOption,
            '--without-bulk' => $withoutBulkOptions,
        ]);

        $this->call('web:generate:request:index', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--force' => $force,
        ]);

        $this->call('web:generate:request:store', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--force' => $force,
        ]);

        $this->call('web:generate:request:update', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--force' => $force,
        ]);

        $this->call('web:generate:request:destroy', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--force' => $force,
        ]);

        if(!$withoutBulkOptions) {
            $this->call('web:generate:request:bulk-destroy', [
                'table_name' => $tableNameArgument,
                '--model-name' => $modelOption,
                '--force' => $force,
            ]);
        }

        $this->call('web:generate:routes', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--controller-name' => $controllerOption,
            '--with-export' => $exportOption,
            '--without-bulk' => $withoutBulkOptions,
        ]);

        $this->call('web:generate:index', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--force' => $force,
            '--with-export' => $exportOption,
            '--without-bulk' => $withoutBulkOptions,
        ]);

        $this->call('web:generate:form', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--force' => $force,
        ]);

        $this->call('web:generate:lang', [
            'table_name' => $tableNameArgument,
            '--model-name' => $modelOption,
            '--with-export' => $exportOption,
        ]);

        if($exportOption){
            $this->call('web:generate:export', [
                'table_name' => $tableNameArgument,
                '--force' => $force,
            ]);
        }

        if ($this->shouldGeneratePermissionsMigration()) {
            $this->call('web:generate:permissions', [
                'table_name' => $tableNameArgument,
                '--model-name' => $modelOption,
                '--force' => $force,
                '--without-bulk' => $withoutBulkOptions,
            ]);

            if ($this->option('no-interaction') || $this->confirm('Do you want to attach generated permissions to the default role now?', true)) {
               $this->call('migrate');
            }
        }

        $this->info('Generating whole web CRUD finished');

    }

    protected function getArguments() {
        return [
            ['table_name', InputArgument::REQUIRED, 'Name of the existing table'],
        ];
    }

    protected function getOptions() {
        return [
            ['model-name', 'm', InputOption::VALUE_OPTIONAL, 'Specify custom model name'],
            ['controller-name', 'c', InputOption::VALUE_OPTIONAL, 'Specify custom controller name'],
            ['seed', 's', InputOption::VALUE_NONE, 'Seeds the table with fake data'],
            ['force', 'f', InputOption::VALUE_NONE, 'Force will delete files before regenerating admin'],
            ['with-export', 'e', InputOption::VALUE_NONE, 'Generate an option to Export as Excel'],
            ['without-bulk', 'wb', InputOption::VALUE_NONE, 'Generate without bulk options'],
        ];
    }

    protected function shouldGeneratePermissionsMigration() {
        if (class_exists('\Savannabits\Craftable\CraftableServiceProvider')) {
            return true;
        }

        return false;
    }

}


/**
 * TODO test belongs_to_many in all generators
 *
 * TODO add template to all + it can be relative or absolute path
 *
 * Admin: seed, controller_name, model_name
 *
 * Model: class_name (App\Models), template, belongs_to_many
 *
 * Controller: class_name (App\Http\Controllers\Admin), model_name, template, belongs_to_many
 *
 * StoreRequest: class_name (App\Http\Requests\Admin\{model_name}), model_name
 *
 * UpdateRequest: class_name (App\Http\Requests\Admin\{model_name}), model_name
 *
 * TODO add DestroyRequest
 * DestroyRequest: class_name (App\Http\Requests\Admin\{model_name}), model_name
 *
 *
 * Appendor:
 *
 * ModelFactory: model_name
 *
 * Routes: model_name, controller_name, template
 *
 *
 * ViewGenerator:
 *
 * ViewForm: file_name, model_name, belongs_to_many
 *
 * TODO refactor ViewFullForm generator
 * ViewFullForm: file_name, model_name, template, name, view_name, route
 *
 * ViewIndex: file_name, model_name, template
 *
 *
 */
