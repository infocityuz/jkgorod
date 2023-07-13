<?php

namespace Modules\ForTheBuilder\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CrudGenerator2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator2
    {name : Class (singular) for example User} {table : Class (singular) for example users}';
    //{table : Class (singular) for example users} {name : Class (singular) for example User}
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $tableName = $this->argument('table');
        $this->controller($name);
        $this->model($name,$tableName);
        $this->request($name,$tableName);
        $routeName =  strtolower($name);
        $routes = "/*-----------------------------{$routeName}---------------------------------*/
         Route::group(['prefix'=>'$routeName'],function(){
            Route::get('/',[{$name}Controller::class, 'index'])->name('forthebuilder.{$routeName}.index');
            Route::get('/create',[{$name}Controller::class, 'create'])->name('forthebuilder.{$routeName}.create');
            Route::post('/store',[{$name}Controller::class, 'store'])->name('forthebuilder.{$routeName}.store');
            Route::get('/edit/{id}',[{$name}Controller::class, 'edit'])->name('forthebuilder.{$routeName}.edit');
            Route::put('/update/{id}',[{$name}Controller::class, 'update'])->name('forthebuilder.{$routeName}.update');
            Route::get('/show/{id}',[{$name}Controller::class, 'show'])->name('forthebuilder.{$routeName}.show');
            Route::delete('/destroy/{id}',[{$name}Controller::class, 'destroy'])->name('forthebuilder.{$routeName}.destroy');
         });
        /*------------------------------{$routeName}------------------------------*/";
        File::append("Modules/ForTheBuilder/Routes/web.php", $routes);

        File::makeDirectory("Modules/ForTheBuilder/Resources/views/{$routeName}");
        return 'success';
    }

    protected function getStub($type)
    {
        return file_get_contents("Modules/ForTheBuilder/Resources/stubs/$type.stub");
    }

    protected function model($name,$tableName)
    {
        $attributes = Schema::connection('mysql2')->getColumnListing($tableName);
        $fields = '';
        $i = 0;
        $count = count($attributes);
        foreach ($attributes as $attribute) {
            if ($attribute != 'id' && $attribute != 'created_at' && $attribute != 'updated_at') {
                $i++;
                if ($i == $count) {
                    $fields .= "'{$attribute}'";
                } else {
                    $fields .= "'{$attribute}', ";
                }
                $type = Schema::getColumnType($tableName, $attribute);
            }
        }

        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{fillable}}',
                '{{table}}',

            ],
            [
                $name,
                $fields,
                strtolower($tableName)
            ],
            $this->getStub('Model')
        );
        file_put_contents( "Modules/ForTheBuilder/Entities/{$name}.php", $modelTemplate);


    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{viewName}}'
            ],
            [
                $name,
                strtolower($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents("Modules/ForTheBuilder/Http/Controllers/{$name}Controller.php", $controllerTemplate);
    }
    protected function request($name,$tableName)
    {

        $attributes = Schema::connection('mysql2')->getColumnListing($tableName);
        $fields = '';
        $rules = '';
        $i = 0;
        $count = count($attributes);
        foreach ($attributes as $attribute) {
            if ($attribute != 'id' && $attribute != 'created_at' && $attribute != 'updated_at') {
                $i++;
                if ($i == $count) {
                    $fields .= "'{$attribute}',\n ";
                } else {
                    $fields .= "'{$attribute}',\n ";
                }
                $type = Schema::getColumnType($tableName, $attribute);
                $rules .= "'{$attribute}' => 'nullable|{$type}',\n";
            }
        }

        $requestTemplate = str_replace(
            [
                '{{modelName}}',
                '{{rulse}}',

            ],
            [
                $name,
                $rules
            ],

            $this->getStub('Request')
        );

        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents("Modules/ForTheBuilder/Http/Requests/{$name}Request.php", $requestTemplate);
    }

}
