<?php

namespace Modules\ForTheBuilder\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\ForTheBuilder\Entities\Deal;
use Modules\ForTheBuilder\Entities\HouseFlat;
use Modules\ForTheBuilder\Entities\InstallmentPlan;
// use Modules\ForTheBuilder\Entities\Leads;
use Modules\ForTheBuilder\Entities\Notification_;
use Modules\ForTheBuilder\Entities\Notifications_;
use Modules\ForTheBuilder\Entities\PayStatus;
use Modules\ForTheBuilder\Entities\Constants;
use Modules\ForTheBuilder\Http\Requests\InstallmentPlanRequest;

class InstallmentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function getNotification()
    {
        $notification = ['Booking', 'BookingPrepayment'];
        $all_task = Notification_::where('type', 'Task')->where(['read_at' => NULL,  'user_id' => Auth::user()->id])->orderBy('created_at', 'desc')->get();
        $all_booking = Notification_::whereIn('type', $notification)->where('read_at', NULL)->orderBy('created_at', 'desc')->get();
        $all_installment_plan = Notification_::where('type', 'Installment_plan')->where('read_at', NULL)->orderBy('created_at', 'desc')->get();
        return ['all_task' => $all_task, 'all_booking' => $all_booking, 'all_installment_plan' => $all_installment_plan];
    }

    public function index()
    {
        $user=Auth::user();
        // $user->role_id==Constants::MANAGER
        if ($user->role_id==Constants::MANAGER) {
            $models = Deal::with('house_flat', 'user', 'client')->where('installment_plan_id', '!=', NULL)
                ->where('user_id',$user->id)->orderBy('id', 'desc')
                ->paginate(15);
        }else {
            $models = Deal::with('house_flat', 'user', 'client')->where('installment_plan_id', '!=', NULL)
                ->orderBy('id', 'desc')
                ->paginate(15);
        }


        // $models = Deal::where('installment_plan_id', '!=', NULL);
       
        // pre($models[0]);

        return view('forthebuilder::installment-plan.index', [
            'models' => $models,
            'all_notifications' => $this->getNotification()
        ]);
    }


    public function paystatusApi()
    {
        $user = Auth::user();
        $models = PayStatus::all();
        $response = [];
        if (!empty($models)) {
            foreach ($models as $model) {
                if(isset($model->notification)){
                    $expire_date = $model->must_pay_date;
                    $response[] = [
                        'id' => $model->id,
                        'first_name' => $model->deal->client->first_name,
                        'last_name' => $model->deal->client->last_name,
                        'is_notify' => $model->notification->is_notify ?? NULL,
                        'expire_dates' => strtotime($expire_date),
                    ];
                }else {
                    $response = [];
                }
            }
        } else {
            $response[] = [];
        }

        return response()->json($response);
    }

    public function paystatusNotification($id)
    {
        $model = PayStatus::find($id);
        $user = Auth::user();
        $notifications = Notifications_::where(['relation_id'=> $id, 'relation_type' =>'installment_plan', 'user_id'=>$user->id])->first();
        if(isset($notifications->id)){
            $notifications->is_notify = 1;
            $notifications->save();
            $expire_date = $model->must_pay_date;
            $notification = new Notification_();
            $paystatus_array = [
                'id' => $model->deal->id,
                'first_name' => $model->deal->client->first_name,
                'last_name' => $model->deal->client->last_name,
                'is_notify' => $model->notification->is_notify ?? NULL,
                'expire_dates' => strtotime($expire_date),
            ];
            $notification->data = json_encode($paystatus_array);
            $notification->notifiable_id = $model->id;
            $notification->type = 'Installment_plan';
            $notification->save();
            return response()->json($notification);
        }else{
            return response()->json('no');
        }
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('forthebuilder::installment-plan.create', ['all_notifications' => $this->getNotification()]);
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
        $model = Deal::findOrFail($id);
        $statuses = PayStatus::where('deal_id', $id)->get();
        foreach ($statuses as $status){
            $status_id_array[] = $status->id;
        }
        $notification = Notification_::where('type', 'Installment_plan')->whereIn( 'notifiable_id', $status_id_array)->first();
        if(isset($notification->id)){
            $notification->read_at = date('Y-m-d');
            $notification->save();
        }
        $all_sum = 0;
        foreach ($statuses as $key => $value) {
            $all_sum += $value->price_to_pay;
        }

        $paid_sum = number_format($model->price_sell-$all_sum,2,',','.');
        $remaining_sum = number_format($model->price_sell-($model->price_sell-$all_sum),2,',','.');

        return view('forthebuilder::installment-plan.show', [
            'model' => $model,
            'paid_sum' => $paid_sum,
            'remaining_sum' => $remaining_sum,
            'statuses' => $statuses,
            'all_notifications' => $this->getNotification()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $model = InstallmentPlan::findOrFail($id);
        return view('forthebuilder::installment-plan.edit', [
            'model' => $model,
            'all_notifications' => $this->getNotification()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(InstallmentPlanRequest $request, $id)
    {
        $data = $request->validated();
        $model = InstallmentPlan::findOrFail($id);
        $model->period = $data['period'];
        $model->percent = $data['percent'];
        $model->an_initial_fee = $data['an_initial_fee'];
        $model->start_date = $data['start_date'];
        $model->month_pay_first = $data['month_pay_first'];
        $model->month_pay_second = $data['month_pay_second'];
        $model->save();
        Log::channel('action_logs2')->info("пользователь обновил Installment plan", ['info-data' => $model]);
        return redirect()->route('forthebuilder.installment-plan.index')->with('success', __('locale.successfully'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $plans = InstallmentPlan::findOrFail($id);
        $plans->delete();

        Log::channel('action_logs2')->info("пользователь удалил " . $plans->period . " Plans", ['info-data' => $plans]);

        return back()->with('success', __('locale.deleted'));
    }

    public function getStatus($id)
    {

        $statuses = PayStatus::where(['installment_plan_id' => $id])->orderBy('pay_start_date', 'asc')->get();

        return response()->json([
            'statuses' => $statuses,
        ]);
    }

    public function paySum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'string|max:25',
        ]);
        if ($validator->fails()) {
            return response()->json($validator);
        }

        $model_paystatus = PayStatus::where(['installment_plan_id' => $request->installment_plan_id, 'deal_id' => $request->deal_id])
            ->WhereIn('status', [Constants::HALF_PAY, Constants::NOT_PAID])->orderBy('id', 'asc')->get();
        // pre($model_paystatus);
        if (!empty($model_paystatus)) {
            $payingSum = $request->sum;
            foreach ($model_paystatus as $key => $value) {
                $value->pay_date = date('Y-m-d');
                $arr = $value->price_history ? json_decode($value->price_history) : [];
                $oldPrice = $value->price_to_pay;
                if ($value->price_to_pay == $payingSum) {
                    $value->price_to_pay = 0;
                    $value->status = Constants::PAID;
                    $arr[] = ['date' => date('Y-m-d H:i:s'), 'price' => $oldPrice - $value->price_to_pay];
                    $value->price_history = json_encode($arr);
                    $value->save();
                    $payingSum = 0;
                    break;
                } else if ($value->price_to_pay > $payingSum) {
                    $value->price_to_pay = $value->price_to_pay - $payingSum;
                    $value->status = Constants::HALF_PAY;
                    $arr[] = ['date' => date('Y-m-d H:i:s'), 'price' => $oldPrice - $value->price_to_pay];
                    $value->price_history = json_encode($arr);
                    $value->save();
                    $payingSum = 0;
                    break;
                } else if ($value->price_to_pay < $payingSum) {
                    $value->price_to_pay = 0;
                    $value->status = Constants::PAID;
                    $arr[] = ['date' => date('Y-m-d H:i:s'), 'price' => $oldPrice - $value->price_to_pay];
                    $value->price_history = json_encode($arr);
                    $value->save();
                    $payingSum = $payingSum - $oldPrice;
                    if ($payingSum <= 0)
                        break;
                }
            }
        }
        // [{"date": "2023-04-03 12:47:28", "price": 15000}]
        return redirect()->back()->with('success', translate('Status change'));
    }

    // public function paySum(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'status' => 'string|max:25',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator);
    //     }
    //     $paystatus = PayStatus::findOrFail($request->id);
    //     $model_paystatus = PayStatus::where(['installment_plan_id' => $paystatus->installment_plan_id])
    //         ->WhereIn('status', ["Част. оплата", "Не оплачен"])->first();
    //     $monthly_sum = 0;
    //     if ($paystatus->plan->period == '12 месяц') {
    //         $monthly_sum = ($paystatus->plan->all_sum - $paystatus->plan->an_initial_fee) / 12;
    //     } else {
    //         $monthly_sum = ($paystatus->plan->all_sum - $paystatus->plan->an_initial_fee) / 18;
    //     }
    //     $sum = $model_paystatus->sum ?? 0;
    //     $j = floor(($request->sum + $sum) / $monthly_sum);
    //     $the_rest_sum = $request->sum + $sum - $monthly_sum * $j;
    //     for ($i = 0; $i < $j; $i++) {
    //         $model = PayStatus::findOrFail($model_paystatus->id + $i);
    //         $model->status = 'Оплачен';
    //         $model->sum = $monthly_sum;
    //         $model->save();
    //     }
    //     $model = PayStatus::findOrFail($model_paystatus->id + $j);
    //     $model->status = 'Част. оплата';
    //     $model->sum = round($the_rest_sum, 2);
    //     $model->save();

    //     return redirect()->back()->with('success', 'Статус измeнён');
    // }

    public function reduceSum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'string|max:25',
        ]);
        if ($validator->fails()) {
            return response()->json($validator);
        }
        if (Auth::user()->status == 1000) {
            $model = PayStatus::findOrFail($request->id);
            $model->status = Constants::NOT_PAID;
            $model->price_to_pay = $model->price;
            $model->pay_date = NULL;
            $model->save();
        } else {
            return redirect()->back()->with('warning', translate('Only an admin can cancel a payment'));
        }

        return redirect()->back()->with('success', translate('Status changed'));
    }

    public function updateStatus(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'string|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json($validator);
        }
        if ($request->ajax()) {

            $model = PayStatus::findOrFail($id);

            $model->status = $request->status;
            $model->save();

            return response()->json([
                'id' => $id,
                'status' => $request->status,
                'success' => 'Статус измeнён'
            ]);
        }
    }
}
