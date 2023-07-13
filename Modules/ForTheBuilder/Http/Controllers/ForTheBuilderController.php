<?php

namespace Modules\ForTheBuilder\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Modules\ForTheBuilder\Entities\House;
use Modules\ForTheBuilder\Entities\HouseFlat;
use Modules\ForTheBuilder\Entities\Leads;
use Modules\ForTheBuilder\Entities\LeadStatus;
use Illuminate\Support\Facades\DB;
use Modules\ForTheBuilder\Entities\Constants;
use Carbon\Carbon;
use Modules\ForTheBuilder\Entities\Deal;
use Modules\ForTheBuilder\Entities\Notification_;


    function getBetweenDates($startDate, $endDate) {
        $rangArray = [];
     
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
     
        for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) {
            $date = date('d.m', $currentDate);
            $rangArray[] = $date;
        }
     
        return $rangArray;
    }


class ForTheBuilderController extends Controller
{


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    /**
     * Class constructor.
     */

    public function getNotification(){
        $notification = ['Booking', 'BookingPrepayment'];
        $all_task = Notification_::where('type', 'Task')->where(['read_at' => NULL,  'user_id' => Auth::user()->id])->orderBy('created_at', 'desc')->get();
        $all_booking = Notification_::whereIn('type', $notification)->where('read_at', NULL)->orderBy('created_at', 'desc')->get();
        $all_installment_plan = Notification_::where('type', 'Installment_plan')->where('read_at', NULL)->orderBy('created_at', 'desc')->get();
        return ['all_task' => $all_task, 'all_booking' => $all_booking, 'all_installment_plan' => $all_installment_plan];
    }

    public function index()
    {
          // Deal
        $connect_for=Constants::FOR_1;
        $connect_new=Constants::NEW_1;

        $user=Auth::user();
        // $user->role_id==Constants::MANAGER
        if ($user->role_id==Constants::MANAGER) {
            
            $new_users=DB::table($connect_for.'.deals as dt1')
                ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
                ->where('dt1.type',Constants::FIRST_CONTACT)
                ->where('dt1.user_id',$user->id)
                // ->distinct('dt1.client_id')
                ->count();
            // dd($new_user);
            $in_negotiations=DB::table($connect_for.'.deals as dt1')
            ->where('dt1.type',Constants::NEGOTIATION)
            ->where('dt1.user_id',$user->id)
            // ->distinct('dt1.client_id')
            ->count();
            $make_deal=DB::table($connect_for.'.deals as dt1')
            ->where('dt1.type',Constants::MAKE_DEAL)
            ->where('dt1.user_id',$user->id)
            // ->distinct('dt1.client_id')
            ->count();

            // Task
            // today
            $date=Carbon::now()->format('Y-m-d');
            $today=DB::table($connect_for.'.task as task')
            //  ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','=',$date)
            ->where('task.user_id',$user->id)
            ->where('task.status',0)
            ->count();
            //  dd($today);
            //  toomorrow
            $datetime = date("Y-m-d", strtotime('tomorrow'));
            //  dd($datetime);
            $tomorrow=DB::table($connect_for.'.task as task')
            //  ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','=',$datetime)
            ->where('task.user_id',$user->id)
            ->where('task.status',0)
            ->count();
            //  dd($tomorrow);
            // week
            $day_after_a_week=Carbon::now()->addDay(7)->format('Y-m-d');
            // dd($day_after_a_week);
            $week=DB::table($connect_for.'.task as task')
            // ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','<',$day_after_a_week)
            ->where('task.user_id',$user->id)
            ->where('task.task_date','>=',$date)
            ->where('task.status',0)
            ->count();

            $full_task=DB::table($connect_for.'.task as task')
            // ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','>=',$date)
            ->where('task.user_id',$user->id)
            ->where('task.status',0)
            ->count();
            // dd($date);
            // $tomorrow_date=Carbon::now()->addDay(1)->format('Y-m-d');
            $overdue_tasks=DB::table($connect_for.'.task as task')
            // ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','<',$date)
            ->where('task.user_id',$user->id)
            ->where('task.status',0)
            ->count();
            // dd($overdue_tasks);

            $house_count=DB::table($connect_for.'.house as house')
            ->where('house.deleted_at',null)
            ->count();


            
            $house_flat_status_free=DB::table($connect_for.'.house_flat as house_flat')
            ->where('house_flat.deleted_at',null)
            ->where('house_flat.status',Constants::STATUS_FREE)
            ->count();
            
            $house_flat_status_booking=DB::table($connect_for.'.house_flat as house_flat')
            ->where('house_flat.deleted_at',null)
            ->where('house_flat.status',Constants::STATUS_BOOKING)
            ->count();

            $house_flat_status_sold=DB::table($connect_for.'.house_flat as dt1')
            ->join($connect_for.'.deals as dt2', 'dt2.house_flat_id', '=', 'dt1.id')
            ->where('dt2.user_id',$user->id)
            ->where('dt1.deleted_at',null)
            ->where('dt1.status',Constants::STATUS_SOLD)
            ->count();

            $installment_count = Deal::where('installment_plan_id', '!=', NULL)                
            ->where('user_id',$user->id)
            ->count();

            $month_prices = DB::table($connect_for.'.deals as dt1')
                ->join($connect_for.'.house_flat as dt2', 'dt2.id', '=', 'dt1.house_flat_id')
                ->join($connect_new.'.users as dt3', 'dt3.id', '=', 'dt1.user_id')
                ->where('dt2.status',Constants::STATUS_SOLD)               
                ->where('dt1.user_id',$user->id)
                ->orderBy('dt3.id', 'desc')
                // ->where('dt3.role_id',2)
                ->select('dt3.id','dt1.price_sell','dt1.date_deal','dt3.first_name','dt3.last_name')
                ->get();
            // dd($month_prices);
                // dd($month_prices);
                // dd($month_prices);


            $price=0;
            $priceArr=[];
            for ($j=0; $j <= 11; $j++) { 
                $priceArr[$j] = 0;
            }
            
            $year=Carbon::now()->format('y');
            $month=Carbon::now()->format('m');
            $last_date = cal_days_in_month(CAL_GREGORIAN, $month,$year);

            $price_day_array = [];
            $month_day = [];
            for ($i=0; $i <= $last_date; $i++) { 
                $price_day_array[$i] = 0;
                $month_day[$i] = $i;
            }
            $core_chart="";
            $in = [];
            foreach ($month_prices as  $value) {
                // dd($value);
                $myDate=$value->date_deal;
                $date_table = Carbon::createFromFormat('Y-m-d', $myDate);
                $month_code = $date_table->format('n');
                $date_day=Carbon::now()->format('m');
                $month_code_day = $date_table->format('j');
                if ($month_code==$date_day) {
                    $in[$value->id]['first_name'] = $value->first_name;
                    $in[$value->id]['price_sell'] = ($in[$value->id]['price_sell'] ?? 0) + $value->price_sell;
                    // $core_chart.="['".$value->first_name."',     ".$value->price_sell."],";
                }
                // dd($month_code);
                
                if ($month_code==$date_day) {
                    $price_day_array[$month_code_day-1] +=$value->price_sell;
                }
                
                // $mont_code = $date_table->format('m');
                $priceArr[$month_code-1] += $value->price_sell;
                $price +=$value->price_sell;
            }
            // dd($in);
            foreach ($in as $key => $value) {
                // dd($value);
                $core_chart.="['".$value['first_name']."',".$value['price_sell']."],";
            }

        } else {

            $new_users=DB::table($connect_for.'.deals as dt1')
            ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('dt1.type',Constants::FIRST_CONTACT)
            // ->distinct('dt1.client_id')
            ->count();
            // dd($new_user);
            $in_negotiations=DB::table($connect_for.'.deals as dt1')
            ->where('dt1.type',Constants::NEGOTIATION)
            // ->distinct('dt1.client_id')
            ->count();
            $make_deal=DB::table($connect_for.'.deals as dt1')
            ->where('dt1.type',Constants::MAKE_DEAL)
            // ->distinct('dt1.client_id')
            ->count();

            // Task
            // today
            $date=Carbon::now()->format('Y-m-d');
            $today=DB::table($connect_for.'.task as task')
            //  ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','=',$date)
            ->where('task.status',0)
            ->count();

            // pre($date);
            //  dd($today);
            //  toomorrow
            $datetime = date("Y-m-d", strtotime('tomorrow'));
            //  dd($datetime);
            $tomorrow=DB::table($connect_for.'.task as task')
            //  ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','=',$datetime)
            ->where('task.status',0)
            ->count();
            //  dd($tomorrow);
            // week
            $day_after_a_week=Carbon::now()->addDay(7)->format('Y-m-d');
            // dd($day_after_a_week);
            $week=DB::table($connect_for.'.task as task')
            // ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','<',$day_after_a_week)
            ->where('task.task_date','>=',$date)
            ->where('task.status',0)
            ->count();

            $full_task=DB::table($connect_for.'.task as task')
            // ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','>=',$date)
            ->where('task.status',0)
            ->count();
            // dd($date);
            // $tomorrow_date=Carbon::now()->addDay(1)->format('Y-m-d');
            $overdue_tasks=DB::table($connect_for.'.task as task')
            // ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
            ->where('task.task_date','<',$date)
            ->where('task.status',0)
            ->count();
            // dd($overdue_tasks);

            $house_count=DB::table($connect_for.'.house as house')
            ->where('house.deleted_at',null)
            ->count();

            // pre($house_count);
            
            $house_flat_status_free=DB::table($connect_for.'.house_flat as house_flat')
            ->where('house_flat.deleted_at',null)
            ->where('house_flat.status',Constants::STATUS_FREE)
            ->count();
            
            $house_flat_status_booking=DB::table($connect_for.'.house_flat as house_flat')
            ->where('house_flat.deleted_at',null)
            ->where('house_flat.status',Constants::STATUS_BOOKING)
            ->count();
            
            $house_flat_status_sold=DB::table($connect_for.'.house_flat as house_flat')
            ->where('house_flat.deleted_at',null)
            ->where('house_flat.status',Constants::STATUS_SOLD)
            ->count();
            // dd($house_flat_status_sold);

            // $installment_count=DB::table($connect_for.'.installment_plan as installment_plan')
            // ->count();
            $installment_count = Deal::where('installment_plan_id', '!=', NULL)
            ->count();



            $month_prices = DB::table($connect_for.'.deals as dt1')
                ->join($connect_for.'.house_flat as dt2', 'dt2.id', '=', 'dt1.house_flat_id')
                ->join($connect_new.'.users as dt3', 'dt3.id', '=', 'dt1.user_id')
                ->where('dt2.status',Constants::STATUS_SOLD)
                ->orderBy('dt3.id', 'desc')
                // ->where('dt3.role_id',2)
                ->select('dt3.id','dt1.price_sell','dt1.date_deal','dt3.first_name','dt3.last_name')
                ->get();


            // dd($month_prices);
                // dd($month_prices);
                // dd($month_prices);


            $price=0;
            $priceArr=[];
            for ($j=0; $j <= 11; $j++) { 
                $priceArr[$j] = 0;
            }
            
            $year=Carbon::now()->format('y');
            $month=Carbon::now()->format('m');
            $last_date = cal_days_in_month(CAL_GREGORIAN, $month,$year);

            $price_day_array = [];
            $month_day = [];
            for ($i=0; $i <= $last_date; $i++) { 
                $price_day_array[$i] = 0;
                $month_day[$i] = $i;
            }
            $core_chart="";
            $in = [];
            foreach ($month_prices as  $value) {
                // dd($value);
                $myDate=$value->date_deal;
                $date_table = Carbon::createFromFormat('Y-m-d', $myDate);
                $month_code = $date_table->format('n');
                $date_day=Carbon::now()->format('m');
                $month_code_day = $date_table->format('j');
                if ($month_code==$date_day) {
                    $in[$value->id]['first_name'] = $value->first_name;
                    $in[$value->id]['price_sell'] = ($in[$value->id]['price_sell'] ?? 0) + $value->price_sell;
                    // $core_chart.="['".$value->first_name."',     ".$value->price_sell."],";
                }
                // dd($month_code);
                
                if ($month_code==$date_day) {
                    $price_day_array[$month_code_day-1] +=$value->price_sell;
                }
                
                // $mont_code = $date_table->format('m');
                $priceArr[$month_code-1] += $value->price_sell;
                $price +=$value->price_sell;
            }
            // dd($in);
            foreach ($in as $key => $value) {
                // dd($value);
                $core_chart.="['".$value['first_name']."',".$value['price_sell']."],";
            }


        }
        

        
        // pre(json_decode($new_users[1]->history));
        // pre($full_task);

        $data=[
           'date_today'=>$date,
           'new_clients'=>$new_users, // Новые клиенты
           'in_negotiations'=>$in_negotiations, // На переговорах
           'make_deal'=>$make_deal, // Заключение сделки
           'today'=>$today,
           'tomorrow'=>$tomorrow,
           'week'=>$week,
           'full_task'=>$full_task,
           'overdue_tasks'=>$overdue_tasks,
           'house_count'=>$house_count,
           'house_flat_status_free'=>$house_flat_status_free,
           'house_flat_status_booking'=>$house_flat_status_booking,
           'house_flat_status_sold'=>$house_flat_status_sold,
           'installment_count'=>$installment_count,
           'price'=>$price,
           'month_sales_price'=>$priceArr,
           'month_day'=>$month_day,
           'price_day_array'=>$price_day_array,
           'core_chart'=>$core_chart

        ];

        $months = [
            translate('January'), 
            translate('February'), 
            translate('March'), 
            translate('April'), 
            translate('May'), 
            translate('June'), 
            translate('July'), 
            translate('August'), 
            translate('September'), 
            translate('October'), 
            translate('November'), 
            translate('December')
        ];
        // dd($data);
        // dd($core_chart);


        // $boughFlatsCount = HouseFlat::where('status',2)->count();
        // $newFlatsCount = HouseFlat::where('status',0)->count();
        // $busyFlatsCount = HouseFlat::where('status',1)->count();

        // $newLeadsCount = LeadStatus::where('name','Новый')->first();

        // if(!empty($newLeadsCount)){
        //     $newLeadsCount = $newLeadsCount->leads->count();
        // }
        
        return view('forthebuilder::index',[
            // 'newLeadsCount' => $newLeadsCount,
            // 'boughFlatsCount' => $boughFlatsCount,
            // 'newFlatsCount' => $newFlatsCount,
            // 'busyFlatsCount' => $busyFlatsCount,
            'data'=>$data,
            'months'=> json_encode($months),
             'all_notifications' => $this->getNotification()
        ]);
    }
    // public function indexLayout()
    // {
    //     $houses = House::all();
    //     return view('forthebuilder::layouts.forthebuilder',[
    //         'houses' => $houses,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('forthebuilder::create', ['all_notifications' => $this->getNotification()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('forthebuilder::show', ['all_notifications' => $this->getNotification()]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('forthebuilder::edit', ['all_notifications' => $this->getNotification()]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function filtr($date)
    {
        if (!empty($date)) {
            $arr = explode(' - ', $date);
            $start = date('Y-m-d 00:00:00', strtotime($arr[0]));
            $end = date('Y-m-d 23:59:59', strtotime($arr[1]));

            // pre($start.'---'.$end);

            // Deal
            $connect_for=Constants::FOR_1;
            $connect_new=Constants::NEW_1;

            $user=Auth::user();

            if ($user->role_id==Constants::MANAGER) {
            
                 //  ----- deal ------
                $new_users = DB::table($connect_for.'.deals as dt1')->select('history')
                ->where('dt1.user_id',$user->id)
                ->whereNotNull('dt1.history',)
                ->get();

                $new_users_count = 0;
                $negotiation_users_count = 0;
                $making_a_deal_users_count = 0;
                
                $new_users_arr = [];
                if (!empty($new_users)) {
                    foreach ($new_users as $key => $value) {
                        $new_arr = json_decode($value->history);
                        foreach ($new_arr as $keyn => $valuen) {
                            // new users
                            if (($valuen->date >= $start && $valuen->date <= $end) && isset($valuen->new_type) && $valuen->new_type == 'First contact') {
                                $new_users_count++;
                            }

                            // negotiation_users
                            if (($valuen->date >= $start && $valuen->date <= $end) && isset($valuen->new_type) && $valuen->new_type == 'Negotiation') {
                                $negotiation_users_count++;
                            }

                            // Making a deal
                            if (($valuen->date >= $start && $valuen->date <= $end) && isset($valuen->new_type) && $valuen->new_type == 'Making a deal') {
                                $making_a_deal_users_count++;
                            }
                        }
                    }    
                }

                // ----- tasks ------

                // Задачи
                $full_task = DB::table($connect_for.'.task as task')
                ->where('task.task_date','>=',$start)
                ->where('task.task_date','<=',$end)
                ->where('task.status',0)
                ->where('task.user_id',$user->id)
                ->count();

                // Просроченные задачи
                $overdue_tasks = DB::table($connect_for.'.task as task')
                ->where('task.task_date','<',$start)
                ->where('task.status',0)
                ->where('task.user_id',$user->id)
                ->count();

                $today = $full_task;
                $tomorrow = 0;
                $week = 0;


                // ----- house count -----
                $house_count = DB::table($connect_for.'.house as house')
                ->where('house.deleted_at',null)
                ->where('house.created_at','>=',$start)
                ->where('house.created_at','<=',$end)
                ->count();

                // ----- house flat free -----
                $house_flat_status_free = DB::table($connect_for.'.house_flat as house_flat')
                ->where('house_flat.deleted_at',null)
                ->where('house_flat.free_end','>=',$start)
                ->where('dt2.user_id',$user->id)
                ->count();

                // ---- house flat booking -----
                $house_flat_status_booking = DB::table($connect_for.'.house_flat as house_flat')
                ->where('house_flat.deleted_at',null)
                ->where('house_flat.booking_end','>=',$start)
                ->where('dt2.user_id',$user->id)
                ->count();
                
                // ---- house flat sold -----
                $house_flat_status_sold = DB::table($connect_for.'.house_flat as house_flat')
                ->where('house_flat.deleted_at',null)
                ->where('house_flat.sold_date','>=',$start)
                ->where('house_flat.sold_date','<=',$end)
                ->where('dt2.user_id',$user->id)
                ->count();

                // ----- installment_plan count ---- 
                $installment_count = Deal::where('installment_plan_id', '!=', NULL)
                ->where('date_deal','>=',$start)
                ->where('date_deal','<=',$end)
                ->where('user_id',$user->id)
                ->count();


                // graph, price
                $month_prices = DB::table($connect_for.'.deals as dt1')
                ->join($connect_for.'.house_flat as dt2', 'dt2.id', '=', 'dt1.house_flat_id')
                ->join($connect_new.'.users as dt3', 'dt3.id', '=', 'dt1.user_id')
                ->where('dt2.status',Constants::STATUS_SOLD)
                ->where('dt2.sold_date','>=',$start)
                ->where('dt2.sold_date','<=',$end)
                ->where('dt1.user_id',$user->id)
                ->orderBy('dt3.id', 'desc')
                // ->where('dt3.role_id',2)
                ->select('dt3.id','dt1.price_sell','dt1.date_deal','dt3.first_name','dt3.last_name')
                ->get();


                

                $price=0;
                $priceArr=[];
                for ($j=0; $j <= 11; $j++) { 
                    $priceArr[$j] = 0;
                }
                
                $dates = getBetweenDates(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
                

                $price_day_array = [];
                $month_day = $dates;
                for ($i=0; $i <= count($dates); $i++) { 
                    $price_day_array[$i] = 0;
                    // $month_day[$i] = $i;
                }
                $core_chart="";
                $in = [];

                
                
                foreach ($month_prices as  $value) {
                    // dd($value);
                    $myDate=$value->date_deal;
                    $date_table = Carbon::createFromFormat('Y-m-d', $myDate);
                    $month_code = $date_table->format('n');
                    $date_day=Carbon::now()->format('m');

                    $month_code_day = $date_table->format('j');
                    
                    if ($month_code == $date_day) {
                        $in[$value->id]['first_name'] = $value->first_name;
                        $in[$value->id]['price_sell'] = ($in[$value->id]['price_sell'] ?? 0) + $value->price_sell;
                        // $core_chart.="['".$value->first_name."',     ".$value->price_sell."],";
                    }
                    // dd($month_code);
                    
                    if ($month_code==$date_day) {
                        $price_day_array[$month_code_day-1] +=$value->price_sell;
                    }
                    
                    // $mont_code = $date_table->format('m');
                    $priceArr[$month_code-1] += $value->price_sell;
                    $price +=$value->price_sell;
                }
                // dd($in);
                foreach ($in as $key => $value) {
                    // dd($value);
                    $core_chart.="['".$value['first_name']."',".$value['price_sell']."],";
                }      
            
            } 
            else {

                //  ----- deal ------
                $new_users = DB::table($connect_for.'.deals as dt1')->select('history')
                // ->join($connect_for.'.clients as dt2', 'dt2.id', '=', 'dt1.client_id')
                ->whereNotNull('dt1.history',)
                ->get();

                $new_users_count = 0;
                $negotiation_users_count = 0;
                $making_a_deal_users_count = 0;
                
                $new_users_arr = [];
                if (!empty($new_users)) {
                    foreach ($new_users as $key => $value) {
                        $new_arr = json_decode($value->history);
                        foreach ($new_arr as $keyn => $valuen) {
                            // new users
                            if (($valuen->date >= $start && $valuen->date <= $end) && isset($valuen->new_type) && $valuen->new_type == 'First contact') {
                                $new_users_count++;
                            }

                            // negotiation_users
                            if (($valuen->date >= $start && $valuen->date <= $end) && isset($valuen->new_type) && $valuen->new_type == 'Negotiation') {
                                $negotiation_users_count++;
                            }

                            // Making a deal
                            if (($valuen->date >= $start && $valuen->date <= $end) && isset($valuen->new_type) && $valuen->new_type == 'Making a deal') {
                                $making_a_deal_users_count++;
                            }
                        }
                    }    
                }

                // ----- tasks ------

                // Задачи
                $full_task = DB::table($connect_for.'.task as task')
                ->where('task.task_date','>=',$start)
                ->where('task.task_date','<=',$end)
                ->where('task.status',0)
                ->count();

                // Просроченные задачи
                $overdue_tasks = DB::table($connect_for.'.task as task')
                ->where('task.task_date','<',$start)
                ->where('task.status',0)
                ->count();

                $today = $full_task;
                $tomorrow = 0;
                $week = 0;


                // ----- house count -----
                $house_count = DB::table($connect_for.'.house as house')
                ->where('house.deleted_at',null)
                ->where('house.created_at','>=',$start)
                ->where('house.created_at','<=',$end)
                ->count();

                // ----- house flat free -----
                $house_flat_status_free = DB::table($connect_for.'.house_flat as house_flat')
                ->where('house_flat.deleted_at',null)
                ->where('house_flat.free_end','>=',$start)
                ->count();

                // ---- house flat booking -----
                $house_flat_status_booking = DB::table($connect_for.'.house_flat as house_flat')
                ->where('house_flat.deleted_at',null)
                ->where('house_flat.booking_end','>=',$start)
                ->count();
                
                // ---- house flat sold -----
                $house_flat_status_sold = DB::table($connect_for.'.house_flat as house_flat')
                ->where('house_flat.deleted_at',null)
                ->where('house_flat.sold_date','>=',$start)
                ->where('house_flat.sold_date','<=',$end)
                ->count();

                // ----- installment_plan count ---- 
                $installment_count = Deal::where('installment_plan_id', '!=', NULL)
                ->where('date_deal','>=',$start)
                ->where('date_deal','<=',$end)
                ->count();


                // graph, price
                $month_prices = DB::table($connect_for.'.deals as dt1')
                ->join($connect_for.'.house_flat as dt2', 'dt2.id', '=', 'dt1.house_flat_id')
                ->join($connect_new.'.users as dt3', 'dt3.id', '=', 'dt1.user_id')
                ->where('dt2.status',Constants::STATUS_SOLD)
                ->where('dt2.sold_date','>=',$start)
                ->where('dt2.sold_date','<=',$end)
                ->orderBy('dt3.id', 'desc')
                // ->where('dt3.role_id',2)
                ->select('dt3.id','dt1.price_sell','dt1.date_deal','dt3.first_name','dt3.last_name')
                ->get();


                

                $price=0;
                $priceArr=[];
                for ($j=0; $j <= 11; $j++) { 
                    $priceArr[$j] = 0;
                }
                
                $dates = getBetweenDates(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
                

                $price_day_array = [];
                $month_day = $dates;
                for ($i=0; $i <= count($dates); $i++) { 
                    $price_day_array[$i] = 0;
                    // $month_day[$i] = $i;
                }
                $core_chart="";
                $in = [];

                
                
                foreach ($month_prices as  $value) {
                    // dd($value);
                    $myDate=$value->date_deal;
                    $date_table = Carbon::createFromFormat('Y-m-d', $myDate);
                    $month_code = $date_table->format('n');
                    $date_day=Carbon::now()->format('m');

                    $month_code_day = $date_table->format('j');
                    
                    if ($month_code == $date_day) {
                        $in[$value->id]['first_name'] = $value->first_name;
                        $in[$value->id]['price_sell'] = ($in[$value->id]['price_sell'] ?? 0) + $value->price_sell;
                        // $core_chart.="['".$value->first_name."',     ".$value->price_sell."],";
                    }
                    // dd($month_code);
                    
                    if ($month_code==$date_day) {
                        $price_day_array[$month_code_day-1] +=$value->price_sell;
                    }
                    
                    // $mont_code = $date_table->format('m');
                    $priceArr[$month_code-1] += $value->price_sell;
                    $price +=$value->price_sell;
                }
                // dd($in);
                foreach ($in as $key => $value) {
                    // dd($value);
                    $core_chart.="['".$value['first_name']."',".$value['price_sell']."],";
                }
                
            }


            $data = [
               'start' => $start,
               'end' => $end,
               'new_clients'=>$new_users_count, // Новые клиенты
               'in_negotiations'=>$negotiation_users_count, // На переговорах
               'make_deal'=>$making_a_deal_users_count, // Заключение сделки
               'today'=>$today,
               'tomorrow'=>$tomorrow,
               'week'=>$week,
               'full_task'=>$full_task,
               'overdue_tasks'=>$overdue_tasks,
               'house_count'=>$house_count,
               'house_flat_status_free'=>$house_flat_status_free,
               'house_flat_status_booking'=>$house_flat_status_booking,
               'house_flat_status_sold'=>$house_flat_status_sold,
               'installment_count'=>$installment_count,
               'price'=>$price,
               'month_sales_price'=>$priceArr,
               'month_day'=>$month_day,
               'price_day_array'=>$price_day_array,
               'core_chart'=>$core_chart
            ];

        }

         return view('forthebuilder::filtr',[
            'data' => $data,
            'all_notifications' => $this->getNotification()
        ]);
    }
}
