<?php

namespace App\Console\Commands;

use App\Models\ApartmentSale;
use Illuminate\Console\Command;

class DeleteParsingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:parsing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        info('delete parsing');
        $models = ApartmentSale::all();
        foreach ($models as $model){
            if($model->olx_url){
                $file_get = file_get_contents($model->olx_url)??0;
                if($file_get == 0){
                    if($model->id != 10 && $model->id != 11){
                        $model->apartment_has()->detach();
                        $model->there_is_nearby()->detach();
                        $model->contacts()->delete();
                        $model->delete();
                    }
                }
            }
        }
        return 0;
    }
}
