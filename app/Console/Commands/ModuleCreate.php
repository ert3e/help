<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ModuleCreate extends Command
{
    protected  $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}
                                        {--all : All items}
                                        {--migration : Only Migration}
                                        {--view : Only View}
                                        {--model : Only Model}
                                        {--controller : Only Controller}
                                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var string
     */
    private $moduleName;

    /**
     * @var string
     */
    private $moduleType;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        list($moduleType, $moduleName) = explode('\\', $name);

        $this->moduleType = $moduleType;
        $this->moduleName = $moduleName;

        if ($this->option('all')) {
            $this->input->setOption("migration", true);
            $this->input->setOption("view", true);
            $this->input->setOption("controller", true);
            $this->input->setOption("model", true);
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('view') && $this->moduleType == 'Admin') {
            $this->createView();
        }

        if ($this->option('controller')) {
            $this->createController();
        }

        if ($this->option('model')) {
            $this->createModel();
        }

    }

    private function createModel()
    {
        try {
            $model = Str::singular(class_basename($this->argument('name')));
            $modelName = Str::singular(Str::studly(class_basename($this->argument('name'))));

            $baseModelPath = $this->getBaseModelPath($this->argument('name'));

            if ($this->alreadyExists($baseModelPath)) {
                $this->error('Base model already exists!');
            } else {
                // создаем базовую модель модуля
                $this->call('make:model', [
                    'name' => "App\\Models\\".$model."Base"
                ]);
            }

            $modelPath = $this->getModelPath($this->argument('name'));

            if ($this->alreadyExists($modelPath)) {
                $this->error('Model of module already exists!');
            } else {
                // создаем модель модуля
                /*$this->call('make:model', [
                    'name' => "App\\Modules\\" . trim($this->argument('name')) . "\\Models\\" . $model
                ]);*/

                $this->makeDirectory($modelPath);

                $stub = $this->files->get(base_path('resources/stubs/model.stub'));

                $stub = str_replace(
                    [
                        'DummyNamespace',
                        'DummyExtendsClass',
                    ],
                    [
                        "App\\Modules\\".trim($this->argument('name'))."\\Models",
                        $modelName,
                    ],
                    $stub
                );

                $this->files->put($modelPath, $stub);
                $this->info('Model of module created successfully.');

            }
        } catch(\Exception $e) {
            $e->getMessage();
        }
    }

    private function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        try {
            $this->call('make:migration', [
                'name' => "create_".$table."_table",
                "--create" => $table
            ]);

        } catch(\Exception $e) {
            $e->getMessage();
        }
    }

    private function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));
        $modelName = Str::singular(Str::studly(class_basename($this->argument('name'))));

        $path = $this->getControllerPath($this->argument('name'));

        if ($this->alreadyExists($path)) {
            $this->error('Controller already exists!');

        } else {

            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/controller.stub'));

            $stub = str_replace(
                [
                    'DummyNamespace',
                    'DummyRootNamespace',
                    'DummyClass',
                    'DummyFullModelClass',
                    'DummyType',
                    'DummyModelVariable',
                ],
                [
                    "App\\Modules\\".trim($this->argument('name'))."\\Controllers",
                    $this->laravel->getNamespace(),
                    $controller.'Controller',
                    "App\\Modules\\".trim($this->argument('name'))."\\Models\\{$modelName}",
                    $this->moduleType,
                    lcfirst(($modelName))
                ],
                $stub
            );

            $this->files->put($path, $stub);
            $this->info("Controller created");

            $this->createRoutes($controller, $modelName);
        }
    }

    private function createRoutes($controller, $modelName)
    {
        $name = $this->argument('name');
        list($type, $moduleName) = explode('\\', $name);

        $routePath = $this->getRoutesPath($name);

        if ($this->alreadyExists($routePath)) {
            $this->error('Routes already exists!');
        } else {

            $this->makeDirectory($routePath);

            $stub = $this->files->get(base_path('resources/stubs/routes.stub'));

            $stub = str_replace(
                [
                    'DummyModuleType',
                    'DummyClass',
                    'DummyRoutePrefix',
                    'DummyModelVariable',
                ],
                [
                    strtolower($type),
                    $controller.'Controller',
                    Str::plural(Str::snake(lcfirst($modelName), '-')),
                    'id'
                ],
                $stub
            );

            $this->files->put($routePath, $stub);
            $this->info('Routes created successfully.');
        }
    }

    /**
     * @param $name
     * @return array
     */
    protected function getViewPath($name)
    {

        $arrFiles = collect([
            'index',
            'add',
            'edit',
            '_form',
        ]);

        //str_replace('\\', '/', $name)
        $paths = $arrFiles->map(function($item) use ($name){
            return base_path('resources/views/'.strtolower(str_replace('\\', '/', $name)).'/'.$item.".blade.php");
        });

        return $paths;
    }

    protected function createView()
    {
        $paths = $this->getViewPath($this->argument('name'));

        foreach($paths as $path) {
            $view = Str::studly(class_basename($this->argument('name')));

            if ($this->alreadyExists($path)) {
                $this->error('View already exists!');
            } else {
                $this->makeDirectory($path);

                $stub = $this->files->get(base_path('resources/stubs/view.stub'));

                $stub = str_replace(
                    [
                        '',
                    ],
                    [
                    ],
                    $stub
                );

                $this->files->put($path, $stub);
                $this->info('View created successfully.');
            }
        }
    }





    private function getRoutesPath($argument)
    {
        return $this->laravel['path'].'/Modules/'.str_replace('\\', '/', $argument)."/Routes/web.php";

    }

    private function getControllerPath($argument)
    {
        $controller = Str::studly(class_basename($argument));

        return $this->laravel['path'].'/Modules/'.str_replace('\\', '/', $argument)."/Controllers/"."{$controller}Controller.php";
    }

    private function getModelPath($argument)
    {
        $model = Str::studly(class_basename($argument));

        return $this->laravel['path'].'/Modules/'.str_replace('\\', '/', $argument)."/Models/"."{$model}.php";
    }

    private function getBaseModelPath($argument)
    {
        $model = Str::studly(class_basename($argument));

        return $this->laravel['path']."/Models/{$model}.php";
    }

    private function makeDirectory($path)
    {
        $this->files->makeDirectory(dirname($path),0777, true, true);
    }

    private function alreadyExists($path)
    {
        return $this->files->exists($path);
    }

}
