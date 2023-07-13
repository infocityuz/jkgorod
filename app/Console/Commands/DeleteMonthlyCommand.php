<?php

namespace App\Console\Commands;

use App\Models\ApartmentSale;
use Illuminate\Console\Command;

class DeleteMonthlyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:delete';

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
        info('hello world after');
        date_default_timezone_set("Asia/Tashkent");
        $now = strtotime('now');
        $apartment_sale = ApartmentSale::select('id')->where('is_parser', 1)->get();
        foreach ($apartment_sale as $apartment){
            if((int)$apartment->after_month < (int)$now){
                $apartment->apartment_has()->detach();
                $apartment->there_is_nearby()->detach();
                $apartment->contacts()->delete();
                $apartment->delete();
            }
        }
        return 0;
    }
}
