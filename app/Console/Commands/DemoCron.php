<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\ForTheBuilder\Entities\PayStatus;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
        $statuses = PayStatus::orderBy('pay_start_date', 'asc')->get(); // where(['installment_plan_id'=>$id])->

        $details = [];
        if (!empty($statuses)) {
            $n = 0;
            foreach ($statuses as $key => $value) {
                $full_name = '';
                $date = '';
                $amount = '';
                $theRestPrice = 0;
                $payment_summa = 0;

                if (isset($value->plan) && isset($value->plan->deal) && isset($value->plan->deal->personal_informations)) {
                    $full_name = $value->plan->deal->personal_informations->full_name;
                    $date = date('d.m.Y', strtotime($value->pay_start_date));
                
                    $theRestPrice = $value->plan->all_sum - $value->plan->an_initial_fee;
                    if (isset($value->sum) && $value->sum != null)
                        $payment_summa = $value->sum;

                    $amount = (ceil(($theRestPrice / 12 - $payment_summa) * 100) / 100 . ' $');

                    $details['title'] = 'Рассрочка';
                    $details['body'] = 'Уважаемый(ая) ' . $full_name . ', Вам необходимо в ' . $date . ' погасить рассрочку в размере: ' . $amount;
                    
                    $gmail = 's.ibrohim97@gmail.com';
                    // $gmail = $value->plan->deal->email;
                    \Mail::to($gmail)->send(new \Modules\ForTheBuilder\Emails\MyTestMail($details));
                }
            }
        }

        return "Cron is running";
    }
}
