<?php

namespace Modules\ForTheBuilder\Http\Controllers;

use App\components\ImageResize;
use App\components\StaticFunctions;
use App\Http\Controllers\Controller;
use App\Models\ApartmentSaleContacts;
use App\Models\ObjectContacts;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\ForTheBuilder\Entities\Deal;
use Modules\ForTheBuilder\Entities\DealsFile;
use Modules\ForTheBuilder\Entities\House;
use Modules\ForTheBuilder\Entities\HouseDocument;
use Modules\ForTheBuilder\Entities\HouseFlat;
use Modules\ForTheBuilder\Entities\InstallmentPlan;
use Modules\ForTheBuilder\Entities\Notification_;
use Modules\ForTheBuilder\Entities\Notifications_;
use Modules\ForTheBuilder\Entities\PayStatus;
use Modules\ForTheBuilder\Entities\PersonalInformations;
use Modules\ForTheBuilder\Http\Requests\DealRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Modules\ForTheBuilder\Entities\Booking;
use Modules\ForTheBuilder\Entities\Clients;
use Modules\ForTheBuilder\Entities\Constants;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

use function Illuminate\Support\Str;


class DealController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        $user=Auth::user();
        // $user->role_id==Constants::MANAGER
        if ($user->role_id==Constants::MANAGER) {
            // dd($user);
            $models = Deal::with('house_flat', 'user')
            ->where('status', Constants::ACTIVE)
            ->where('user_id',$user->id)
            // ->select('id', 'user_id', 'house_flat_id', 'price_sell', 'date_deal', 'description')
            ->orderBy('type', 'asc')->get(); //->paginate(config('params.pagination'));
        }else {
            $models = Deal::with('house_flat', 'user')->where('status', Constants::ACTIVE)
            // ->select('id', 'user_id', 'house_flat_id', 'price_sell', 'date_deal', 'description')
            ->orderBy('type', 'asc')->get(); //->paginate(config('params.pagination'));
           
        }

        $arr = [
            translate('First contact') => ['class' => 'lidiRed'],
            translate('Negotiation') => ['class' => 'lidiYellow'],
            translate('Making a deal') => ['class' => 'lidiGreen'],
        ];
        if (!empty($models)) {
            $i = 0;
            foreach ($models as $key => $value) {
                $keyArr = '';
                $class = '';
                switch ($value->type) {
                    case Constants::FIRST_CONTACT:
                        $keyArr = translate('First contact');
                        $class = 'lidiRed';
                        break;
                    case Constants::NEGOTIATION:
                        $keyArr = translate('Negotiation');
                        $class = 'lidiYellow';
                        break;
                    case Constants::MAKE_DEAL:
                        $keyArr = translate('Making a deal');
                        $class = 'lidiGreen';
                        break;
                    default:
                        $keyArr = translate('First contact');
                        $class = 'lidiRed';
                        break;
                }

                if ($value->client) {
                    $arr[$keyArr]['id'] = $value->id;
                    $arr[$keyArr]['class'] = $class;
                    $arr[$keyArr]['list'][$i]['responsible'] = (isset($value->user)) ? $value->user->last_name . ' ' . $value->user->first_name : '';
                    $arr[$keyArr]['list'][$i]['client'] = (isset($value->client)) ? $value->client->last_name . ' ' . $value->client->first_name . ' ' . $value->client->middle_name : '';
                    $arr[$keyArr]['list'][$i]['client_id'] = $value->client->id ?? 0;
                    $arr[$keyArr]['list'][$i]['day'] = ($value->date_deal) ? date('d.m.Y', strtotime($value->date_deal)) : '';
                    $arr[$keyArr]['list'][$i]['time'] = ($value->date_deal) ? date('H:i', strtotime($value->date_deal)) : '';
                    $i++;
                }
            }
        }

        return view('forthebuilder::deal.index', [
            'arr' => $arr,
            'all_notifications' => $this->getNotification()
        ]);
    }

    public function getFlat(Request $request)
    {
        $flats = HouseFlat::where("house_id", $request->house_id)->where("status", '!=', 2)->get();
        return response()->json($flats);
    }

    public function getFlatPrice(Request $request)
    {
        $flat = HouseFlat::where("id", $request->id)->andWhere("status", '!=', 2)->first();
        return response()->json($flat);
    }

    public function getFlatContractNumber(Request $request)
    {
        $flat_contract_number = HouseFlat::select('contract_number')->where("id", $request->house_flat_id)->where("status", '!=', 2)->first();
        return response()->json($flat_contract_number);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $houses = House::all();
        // $houseFlat = HouseFlat::
        // $getHouse = '';
        // if ($request->house_id)
        //     $getHouse = House::find($request->house_id);
        $house_flat = HouseFlat::find($request->house_flat_id);
        $clients = Clients::find($request->client_id);
        $house_flat = $house_flat?$house_flat:'NULL';
        $clients = $clients?$clients:'NULL';
        if(isset($clients->id)){
            $clients = $clients;
        }else{
            $clients = 'NULL';
        }
        $house_flat = $house_flat->id?$house_flat:'NULL';
        $deal_agreement_number = Deal::select('agreement_number')->latest('id')->first();

        $agreement_number_increment = ((!empty($deal_agreement_number)) ? ((int)substr($deal_agreement_number->agreement_number, 0, -6)) : 0) + 1;
        $installmentPlan = InstallmentPlan::get();
        // pre($installmentPlan);

        // if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal')))
        //     $dealFiles = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal'));
        return view('forthebuilder::deal.create', [
            'houses' => $houses,
            'house_flat' => $house_flat,
            'clients' => $clients,
            'agreement_number_increment' => $agreement_number_increment,
            'installmentPlan' => $installmentPlan,
            'all_notifications' => $this->getNotification()
            // 'getHouse' => $getHouse,
            // 'dealFiles' => $dealFiles ?? ''
        ]);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        // Generate the Word file
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        
        // Your HTML content
        $htmlContent = view('forthebuilder::deal.print');
        
        // Add the HTML content to the section
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent);
        
        // Save the Word document
        $filename = 'word_document.docx';
        $phpWord->save($filename, 'Word2007');
        
        // Download the Word file
        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function printContract($id)
    {
        $model = Deal::findOrFail($id);
        $houseFlatItem = HouseFlat::find($model->house_flat_id);
        $house = House::findOrFail($houseFlatItem->house_id);

        

        $has_pay_status = PayStatus::where(['deal_id' => $model->id])->get();

        $insPlan = InstallmentPlan::find($model->installment_plan_id);
        
        $total_m2 = json_decode($houseFlatItem->areas)->total;
        $housing_m2 = json_decode($houseFlatItem->areas)->housing;
        $basement_m2 = json_decode($houseFlatItem->areas)->basement;
        $terraca_m2 = json_decode($houseFlatItem->areas)->terraca;
        $attic_m2 = json_decode($houseFlatItem->areas)->attic;
        $balcony_m2 = json_decode($houseFlatItem->areas)->balcony;
        $kitchen_m2 = json_decode($houseFlatItem->areas)->kitchen;
        $live_m2 = $total_m2-($basement_m2+$terraca_m2+$balcony_m2+$attic_m2);

        $pay_to_month = 0;
        if ($model->installment_plan_id) {
            $pay_to_month = $model->price_sell/$model->installmentPlan->period;
            if ($model->initial_fee > 0) {
                $pay_to_month = ($model->price_sell-$model->initial_fee)/$model->installmentPlan->period;
            }
        }
        
        $data = [
            "corpus" => $house->corpus,
            "floor" => $houseFlatItem->floor,
            "room_count" => $houseFlatItem->room_count,
            "total_m2" => $total_m2,
            "kitchen_m2" => $kitchen_m2,
            "live_m2" => $live_m2,
            "housing_m2" => $housing_m2,
            "basement_m2" => $basement_m2,
            "terraca_m2" => $terraca_m2,
            "attic_m2" => $attic_m2,
            "balcony_m2" => $balcony_m2,
            "number_of_flat" => $houseFlatItem->number_of_flat,
            "pay_to_month" => $pay_to_month,

            "house_id" => $houseFlatItem->house->id,
            "house_flat_number" => $houseFlatItem->number_of_flat,
            "doc_number" => $model->agreement_number,
            "description" => $model->description,
            "house_flat_id" => $houseFlatItem->id,
            "date_deal" => $model->date_deal,
            "phone_number" => $model->client->phone,
            "additional_phone" => $model->client->additional_phone,
            "email" => $model->client->email,
            "agreement_number" => $model->agreement_number,
            "price_sell" => $model->price_sell,
            "price_sell_m2" => $model->price_sell_m2,
            "price_sell_word" => "__________________",
            "client_id" => $model->client->id,
            "first_name" => $model->client->first_name,
            "last_name" => $model->client->last_name,
            "middle_name" => $model->client->middle_name,
            "gender" => $model->client->gender,
            "series_number" => (($model->client->informations) ? $model->client->informations->series_number : ''),
            "given_date" => (($model->client->informations) ? $model->client->informations->given_date : ''),
            "issued_by" => (($model->client->informations) ? $model->client->informations->issued_by : ''),
            "live_address" => (($model->client->informations) ? $model->client->informations->address : ''),
            "inn" => (($model->client->informations) ? $model->client->informations->inn : ''),
            "is_installment" => ($model->installment_plan_id ? 'on' : NULL),
            "period" => $model->installmentPlan->period ?? '',
            "percent" => $model->installmentPlan->percent_type ?? '',
            "initial_fee" => (($model->initial_fee > 0) ? $model->initial_fee : 0),
            "installment_date" => $model->initial_fee_date,
            "contract_number" => $model->agreement_number,
            "model_deal_id" => null,
            "model_personal_id" => null,
            "model_budget" => null,
            "model_looking_for" => null,
            "model_house_id" => null,
            "model_house_flat_id" => null,
            "model_client_id" => null,
            "model_type" => null,
            "birth_date" => $model->client->birth_date,
            "passport_or_id" => "1",
            "user_id" => $model->user_id
        ];
        
        

        $view = 'forthebuilder::deal.print';
        // $view = 'forthebuilder::deal.new_print';
        if (isset($data['is_installment']) && $data['is_installment'] != NULL)
            $view = 'forthebuilder::deal.printR';
            // $view = 'forthebuilder::deal.new_print';

        $url = route('forthebuilder.clients.show', [$model->client->id, $houseFlatItem->id, 0]);
        // $area = json_decode($houseFlatItem->ares_price)->hundred->total;
        // dd($has_pay_status);
        return view($view, [
            'model' => $model,
            'data' => $data,
            'houseFlatItem' => $houseFlatItem,
            'url' => $url,
            'has_pay_status' => $has_pay_status,
            'percent' => $insPlan->percent_type ?? 0,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DealRequest $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $auth_user_id = Auth::user()->id;
            $data['user_id'] = $auth_user_id;




            


            $houseFlatItem = HouseFlat::findOrFail($data['house_flat_id']);
            $houseFlatItem->number_of_flat = $data['house_flat_number'];
            $houseFlatItem->doc_number = $data['doc_number'];
            $houseFlatItem->status = Constants::STATUS_SOLD;
            $time = time()-1;
            $houseFlatItem->booking_end = date("Y-m-d H:i:s", $time);
            $houseFlatItem->sold_date = date("Y-m-d H:i:s");
            $houseFlatItem->save();

            

            $client_id = $data['client_id'];
            // pre($existPersonalInfo);
            if (isset($data['client_id']) && $data['client_id'] != null && $data['client_id'] != 'null') {
                $existPersonalInfo = PersonalInformations::where(['client_id' => $data['client_id'], 'series_number' => $data['series_number']])->first();

                if (isset($existPersonalInfo)) {
                    $existClient = Clients::find($data['client_id']);
                    $existClient->first_name = $data['first_name'];
                    $existClient->last_name = $data['last_name'];
                    $existClient->middle_name = $data['middle_name'];
                    $existClient->phone = $data['phone_number'];
                    $existClient->additional_phone = $data['additional_phone'];
                    $existClient->birth_date = $data['birth_date'];
                    $existClient->save();
                    $client_id = $existClient->id;
                }
            } else {
                $newClient = new Clients();
                $newClient->first_name = $data['first_name'];
                $newClient->last_name = $data['last_name'];
                $newClient->middle_name = $data['middle_name'];
                $newClient->phone = $data['phone_number'];
                $newClient->additional_phone = $data['additional_phone'];
                $newClient->birth_date = $data['birth_date'];
                $newClient->status = Constants::CLIENT_ACTIVE;
                $newClient->save();

                $client_id = $newClient->id;
                if (isset($data['series_number'])) {
                    $newPersonalInfo = new PersonalInformations();
                    $newPersonalInfo->client_id = $newClient->id;
                    $newPersonalInfo->series_number = $data['series_number'];
                    $newPersonalInfo->save();
                }
            }

            // $model = new Deal();
            $model = Deal::firstOrNew(['house_flat_id' => $data['house_flat_id']]);
            $model->user_id = $auth_user_id;
            $model->house_flat_id = $data['house_flat_id'];
            $model->house_id = $houseFlatItem->house_id;
            $model->client_id = $client_id;
            $model->price_sell = $data['price_sell'];
            $model->price_sell_m2 = $data['price_sell_m2'];
            $model->agreement_number = $data['house_flat_number'];
            $model->date_deal = $data['date_deal'];
            $model->description = $data['description'];
            $model->type = Constants::MAKE_DEAL;
            $model->status = Constants::COMPLETE;
            if (isset($data['is_installment'])) {
                $model->installment_plan_id = $data['period'];
                $model->initial_fee = $data['initial_fee'];
                $model->initial_fee_date = date('Y-m-d H:i:s', strtotime($data['installment_date']));
            }
            $model->history = json_encode([['date' => date('Y-m-d H:i:s'), 'user' => $user->first_name, 'user_id' => $user->id, 'user_photo' => $user->avatar, 'new_type' => 'Making a deal', 'old_type' => NULL]]);
            $model->save();

            // --------
            $house = House::findOrFail($houseFlatItem->house_id);
            $has_pay_status = PayStatus::where(['deal_id' => $model->id])->get();
            $insPlan = InstallmentPlan::find($model->installment_plan_id);
            $total_m2 = json_decode($houseFlatItem->areas)->total;
            $housing_m2 = json_decode($houseFlatItem->areas)->housing;
            $basement_m2 = json_decode($houseFlatItem->areas)->basement;
            $terraca_m2 = json_decode($houseFlatItem->areas)->terraca;
            $attic_m2 = json_decode($houseFlatItem->areas)->attic;
            $balcony_m2 = json_decode($houseFlatItem->areas)->balcony;
            $kitchen_m2 = json_decode($houseFlatItem->areas)->kitchen;
            $live_m2 = $total_m2-($basement_m2+$terraca_m2+$balcony_m2+$attic_m2);

            $pay_to_month = 0;
            if ($model->installment_plan_id) {
                $pay_to_month = $model->price_sell/$model->installmentPlan->period;
                if ($model->initial_fee > 0) {
                    $pay_to_month = ($model->price_sell-$model->initial_fee)/$model->installmentPlan->period;
                }
            }

            $data["corpus"] = $house->corpus;
            $data["floor"] = $houseFlatItem->floor;
            $data["room_count"] = $houseFlatItem->room_count;
            $data["total_m2"] = $total_m2;
            $data["kitchen_m2"] = $kitchen_m2;
            $data["live_m2"] = $live_m2;
            $data["housing_m2"] = $housing_m2;
            $data["basement_m2"] = $basement_m2;
            $data["terraca_m2"] = $terraca_m2;
            $data["attic_m2"] = $attic_m2;
            $data["balcony_m2"] = $balcony_m2;
            $data["number_of_flat"] = $houseFlatItem->number_of_flat;
            $data["pay_to_month"] = $pay_to_month;
            $data["deal_id"] = $model->id;

            // --------


            $url = '/forthebuilder/deal';
            $has_pay_status = [];
            if (isset($data['is_installment']) && $data['is_installment'] != NULL) {
                $url = '/forthebuilder/installment-plan';
                #2 ========== code refactoring new version
                $insPlan = InstallmentPlan::find($data['period']);
                $iCount = $insPlan->period;

                // pre($data['price_sell'] . ' - ' . ($data['initial_fee'] ?? 0) . ' / ' . $iCount);
                $must_pay_price = ($data['price_sell'] - ($data['initial_fee'] ?? 0)) / $iCount;
                $month_plus = 1;
                for ($i = 0; $i < $iCount; $i++) {
                    $pay_status = new PayStatus();
                    $pay_status->deal_id = $model->id;
                    $pay_status->installment_plan_id = $insPlan->id;
                    $pay_status->must_pay_date = date('Y-m-d H:i:s', strtotime($data['installment_date'] . '+' . $month_plus . ' month'));
                    $pay_status->price = $must_pay_price;
                    $pay_status->price_to_pay = $must_pay_price;
                    $pay_status->status = Constants::NOT_PAID;
                    $pay_status->save();

                    $notifications = new Notifications_();
                    $notifications->relation_id = $pay_status->id;
                    $notifications->user_id = $user->id;
                    $notifications->relation_type = "installment_plan";
                    $notifications->save();

                    $month_plus++;
                    $has_pay_status[] = $pay_status;
                }
            }
            #2 ========== finish code refactoring new version

            //=================== file yuklanyapti ===================
            $image = $data['files'] ?? '';
            if (!empty($image)) {
                $imageName = md5(time().$image).'.'.$image->getClientOriginalExtension();
                // $filesize =  File::size($sourcePath);
                $data['files'] = $imageName;
            }
            // dd($image);

            if (!empty($image)) {
                //bu yerda orginal rasm yuklanyapti ochilgan papkaga
                $image->move(public_path('uploads/deal/'.$model->id),$imageName);

                //bu yerda orginal rasm  app/components/imageresize.php fayliga kesiladigan rasm manzili ko'rsatilyapti
                $imageR = new ImageResize( public_path('uploads/deal/'.$model->id . '/' . $imageName));

                //bu yerda orginal rasm  app/components/imageresize.php fayli orqali kesilyapti
                $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/deal/' . $model->id . '/l_' . $imageName));
                $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/deal/' . $model->id . '/m_' . $imageName));
                $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/deal/' . $model->id . '/s_' . $imageName));

                //bu yerda orginal rasm  o'chirilyapti.chunki endi bizga kerakmas orginali biz o'zimizga kerkligicha kesib oldik
                DealsFile::create([
                    'deal_id' => $model->id,
                    'name' => $image->getFilename(),
                    'guid' => $imageName,
                    'ext' => $image->getExtension(),
                    'size' => $filesize ?? '',
                    // 'main_image' => $j == 1 ? 1 : 0,
                ]);
                File::delete(public_path('uploads/deal/'.$model->id.'/'.$imageName));
            }


        

            
            DB::commit();
            Log::channel('action_logs2')->info("пользователь создал новую deal : ", ['info-data' => $model]);
            $view = 'forthebuilder::deal.print';
            // $view = 'forthebuilder::deal.new_print';
            if (isset($data['is_installment']) && $data['is_installment'] != NULL)
                $view = 'forthebuilder::deal.printR';
                // $view = 'forthebuilder::deal.new_print';

            // $area = json_decode($houseFlatItem->ares_price)->hundred->total;
            // dd($has_pay_status);
            return view($view, [
                'model' => $model,
                'data' => $data,
                'houseFlatItem' => $houseFlatItem,
                'url' => $url,
                'has_pay_status' => $has_pay_status,
                'percent' => $insPlan->percent_type ?? 0,
            ]);

            // return response()->download(public_path('uploads/deal_word/' . $filename));
            // return response()->download($filename)->deleteFileAfterSend(true);

            // return redirect()->route($url)->with('success', translate('successfully'));
        } catch (\Exception $e) {
            //=================== file yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================
            dd($e->getMessage());
            DB::rollBack();
            // dd('................ Exception Error' . $e->getMessage());
        }
    }

    public function returnDownload($filename) {
        return response()->download($filename)->deleteFileAfterSend(true);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deal)
    {
        //show.blade.php
        //{{route('forthebuilder.deal.show',['deal' => $model->id])}}
        //web.php
        //Route::get('show/{deal}',[DealController::class, 'show']);

        // bu endi kerak emas =>; $model = Deal::findOrFail($id);

        return view('forthebuilder::deal.show', [
            'model' => $deal,
            'all_notifications' => $this->getNotification()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $houses = House::all();
        $house_flat = HouseFlat::find($request->house_flat_id);
        $clients = Clients::find($request->client_id);
        $house_flat = $house_flat->id?$house_flat:'NULL';
        $clients = $clients->id?$clients:'NULL';
        $deal_agreement_number = Deal::select('agreement_number')->latest('id')->first();

        $agreement_number_increment = ((!empty($deal_agreement_number)) ? ((int)substr($deal_agreement_number->agreement_number, 0, -6)) : 0) + 1;
        $model = Deal::find($request->deal_id);
        $installmentPlan = InstallmentPlan::get();
        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal'))) {
            $dealFiles = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal'));
        }
        return view('forthebuilder::deal.edit', [
            'houses' => $houses,
            'house_flat' => $house_flat,
            'clients' => $clients,
            'agreement_number_increment' => $agreement_number_increment,
            'installmentPlan' => $installmentPlan,
            'all_notifications' => $this->getNotification(),
            'model' => $model,
            'dealFiles' => $dealFiles ?? ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DealRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $auth_user_id = Auth::user()->id;
            $data['user_id'] = $auth_user_id;

            $houseFlatItem = HouseFlat::findOrFail($data['house_flat_id']);
            $houseFlatItem->number_of_flat = $data['house_flat_number'];
            $houseFlatItem->doc_number = $data['doc_number'];
            $houseFlatItem->status = Constants::STATUS_SOLD;

            $time = time()-1;
            $houseFlatItem->booking_end = date("Y-m-d H:i:s", $time);
            $houseFlatItem->sold_date = date("Y-m-d H:i:s");
            
            
            $houseFlatItem->save();

            $client_id = $data['client_id'];
            // pre($existPersonalInfo);
            if (isset($data['client_id']) && $data['client_id'] != null && $data['client_id'] != 'null') {
                $existPersonalInfo = PersonalInformations::where(['client_id' => $data['client_id'], 'series_number' => $data['series_number']])->first();

                if (isset($existPersonalInfo)) {
                    $existClient = Clients::find($data['client_id']);
                    $existClient->first_name = $data['first_name'];
                    $existClient->last_name = $data['last_name'];
                    $existClient->middle_name = $data['middle_name'];
                    $existClient->phone = $data['phone_number'];
                    $existClient->additional_phone = $data['additional_phone'];
                    $existClient->save();
                    $client_id = $existClient->id;
                }
            } else {
                $newClient = new Clients();
                $newClient->first_name = $data['first_name'];
                $newClient->last_name = $data['last_name'];
                $newClient->middle_name = $data['middle_name'];
                $newClient->phone = $data['phone_number'];
                $newClient->additional_phone = $data['additional_phone'];
                $newClient->status = Constants::CLIENT_ACTIVE;
                $newClient->save();

                $client_id = $newClient->id;
                if (isset($data['series_number'])) {
                    $newPersonalInfo = new PersonalInformations();
                    $newPersonalInfo->client_id = $newClient->id;
                    $newPersonalInfo->series_number = $data['series_number'];
                    $newPersonalInfo->given_date = $data['given_date'];
                    $newPersonalInfo->live_address = $data['live_address'];
                    $newPersonalInfo->inn = $data['inn'];
                    $newPersonalInfo->save();
                }
            }

            // $model = new Deal();
            $model = Deal::find($id);
            $model->user_id = $auth_user_id;
            $model->house_flat_id = $data['house_flat_id'];
            $model->house_id = $houseFlatItem->house_id;
            $model->client_id = $client_id;
            $model->price_sell = $data['price_sell'];
            $model->agreement_number = $data['agreement_number'];
            $model->date_deal = $data['date_deal'];
            $model->description = $data['description'];
            // $model->type = Constants::MAKE_DEAL;
            $model->status = Constants::COMPLETE;
            if (isset($data['is_installment'])) {
                $model->installment_plan_id = $data['period'];
                $model->initial_fee = $data['initial_fee'];
                $model->initial_fee_date = date('Y-m-d H:i:s', strtotime($data['installment_date']));
            }

            $user = Auth::user();
            date_default_timezone_set("Asia/Tashkent");

            if (isset($request->model_budget)) {
                $model->budget = (float)$request->model_budget;
            }
            if (isset($request->model_looking_for)) {
                $model->looking_for = $request->model_looking_for;
            }
            if (isset($request->house_id)) {
                $model->house_id = $request->house_id;
            }
            if (isset($request->house_flat_id)) {
                $model->house_flat_id = $request->house_flat_id;
            }
            switch ($model->type) {
                case 1:
                    $old_type = 'First contact';
                    break;
                case 2:
                    $old_type = 'Negotiation';
                    break;
                case 3:
                    $old_type = 'Making a deal';
                    break;
            }
            switch ($request->model_type) {
                case 1:
                    $new_type = 'First contact';
                    break;
                case 2:
                    $new_type = 'Negotiation';
                    break;
                case 3:
                    $new_type = 'Making a deal';
                    break;
            }
            $model->type = $request->model_type;
            if ($model->history == NULL) {
                $model->history = json_encode([['date' => date('Y-m-d H:i:s'), 'user' => $user->first_name, 'user_id' => $user->id, 'user_photo' => $user->avatar, 'new_type' => $new_type, 'old_type' => $old_type]]);
            } else {
                $old_history = json_decode($model->history);
                $old_history[] = ['date' => date('Y-m-d H:i:s'), 'user' => $user->first_name, 'user_id' => $user->id,  'user_photo' => $user->avatar, 'new_type' => $new_type, 'old_type' => $old_type];
                $model->history = json_encode($old_history);
            }
            $model->save();

            if (isset($data['is_installment']) && $data['is_installment'] != NULL) {
                #2 ========== code refactoring new version
                $insPlan = InstallmentPlan::find($data['period']);
                $iCount = $insPlan->period;

                // pre($data['price_sell'] . ' - ' . ($data['initial_fee'] ?? 0) . ' / ' . $iCount);
                $must_pay_price = ($data['price_sell'] - ($data['initial_fee'] ?? 0)) / $iCount;
                for ($i = 0; $i < $iCount; $i++) {
                    $pay_status = new PayStatus();
                    $pay_status->deal_id = $model->id;
                    $pay_status->installment_plan_id = $insPlan->id;
                    $pay_status->must_pay_date = date('Y-m-d H:i:s', strtotime($data['installment_date'] . '+1 month'));
                    $pay_status->price = $must_pay_price;
                    $pay_status->price_to_pay = $must_pay_price;
                    $pay_status->status = Constants::NOT_PAID;
                    $pay_status->save();
                    $pay_notify = Notifications_::where(['relation_type' => "installment_plan", 'relation_id'=>$pay_status->id])->first();
                    if(isset($pay_notify->id)){
                        $pay_notify->relation_id = $pay_status->id;
                        $pay_notify->user_id = $user->id;
                        $pay_notify->relation_type = "installment_plan";
                        $pay_notify->save();
                    }else{
                        $notifications = new Notifications_();
                        $notifications->relation_id = $pay_status->id;
                        $notifications->user_id = $user->id;
                        $notifications->relation_type = "installment_plan";
                        $notifications->save();
                    }

                }
            }
            #2 ========== finish code refactoring new version

            //=================== file yuklanyapti ===================
            if (!file_exists(public_path('uploads/deal/' . $model->id))) {
                $path = public_path('uploads/deal/' . $model->id);
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal'))) {
                $dealFiles = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal'));
                $j = 0;
                foreach ($dealFiles as $dealFileItem) {
                    $j++;
                    $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id . '/deal/' . $dealFileItem->getFilename());
                    $filenamehash = md5($dealFileItem->getFilename() . time()) . '.' . $dealFileItem->getExtension();
                    $filesize =  File::size($sourcePath);

                    $pathInfo = pathinfo($sourcePath);
                    if ($pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpeg') {
                        $imageR = new ImageResize($sourcePath);
                        $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/deal/' . $model->id . '/l_' . $filenamehash));
                        $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/deal/' . $model->id . '/m_' . $filenamehash));
                        $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/deal/' . $model->id . '/s_' . $filenamehash));
                    } else {
                        $storageDestinationPath = public_path('uploads/deal/' . $model->id . '/' . $filenamehash);
                        File::move($sourcePath, $storageDestinationPath);
                    }

                    DealsFile::create([
                        'deal_id' => $model->id,
                        'name' => $dealFileItem->getFilename(),
                        'guid' => $filenamehash,
                        'ext' => $dealFileItem->getExtension(),
                        'size' => $filesize ?? '',
                        'main_image' => $j == 1 ? 1 : 0,
                    ]);

                    File::delete($sourcePath);
                }
            }

            DB::commit();
            Log::channel('action_logs2')->info("пользователь создал новую deal : ", ['info-data' => $model]);
            return redirect()->route('forthebuilder.clients.show', [$model->client_id, "0", "0"])->with('status', translate('successfully'));

        } catch (\Exception $e) {
            //=================== file yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================
            dd($e->getMessage());
            DB::rollBack();
            // dd('................ Exception Error' . $e->getMessage());
        }


    }
    //==================== kartik fileinput resource/deal/create scripts dagi fileinputga qara ==================================
    // StaticFunctions::convertNumberToWord();

    public function fileUpload(Request $request)
    {
        $foldername = 'deal'; //web.php dagi shu controllerning prefixi
        return StaticFunctions::fileUploadKartikWithAjax($request, 'forthebuilder', $foldername);
    }


    public function fileRenameForSort(Request $request)
    {
        if ($request->ajax()) {
            dd("True request!");
        }
        // dd($request->all());
        // if ($request->ajax()) {
        //     // dd(response()->json($request->all()));
        //     dd($request->all());
        // }
        // $filePath = public_path('/uploads/tmp_files/' . Auth::user()->id.'/deal/'.$key);
        // $fileRename = public_path('/uploads/tmp_files/' . Auth::user()->id.'/deal/'.$key);

        // return rename($filePath, $fileRename);
    }

    public function fileDelete(Request $request, $key)
    {
        $filePath = public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal/' . $key);
        return File::delete($filePath);
    }

    //==================== yakunladni kartik fileinput resource/deal/create scripts dagi fileinputga qara ==================================

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealModel = Deal::findOrFail($id);

        $DealsFilemodels = DealsFile::where('deal_id', $id)->get();

        foreach ($DealsFilemodels as $DealsFilemodel) {
            File::delete(public_path('uploads/deal/' . $DealsFilemodel->deal_id . '/l_' . $DealsFilemodel->guid));
            File::delete(public_path('uploads/deal/' . $DealsFilemodel->deal_id . '/s_' . $DealsFilemodel->guid));
            File::delete(public_path('uploads/deal/' . $DealsFilemodel->deal_id . '/m_' . $DealsFilemodel->guid));
            $DealsFilemodel->delete();
        }

        $dealModel->delete();
        if (isset($dealModel->house_flat->id)) {
            $dealModel->house_flat->status = 0;
            $dealModel->house_flat->save();
        }
        if (isset($dealModel->plan)) {
            $dealModel->plan->delete();
        }
        Log::channel('action_logs2')->info("пользователь удалил deal", ['info-data' => $dealModel]);
        return back()->with('success', __('locale.deleted'));
    }

    public function destroy_file_item(Request $request, $id)
    {
        if ($request->ajax()) {
            $model = DealsFile::findOrFail($id);
            File::delete(public_path('uploads/deal/' . $model->deal_id . '/l_' . $model->guid));
            File::delete(public_path('uploads/deal/' . $model->deal_id . '/s_' . $model->guid));
            File::delete(public_path('uploads/deal/' . $model->deal_id . '/m_' . $model->guid));
            $model->delete();
            return response()->json([
                'success' => __('locale.deleted')
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFromBooking(Request $request, $id)
    {
        $houses = House::all();
        $booking = Booking::find($id);

        $deal_agreement_number = Deal::select('agreement_number')->latest('id')->first();

        $agreement_number_increment = ((!empty($deal_agreement_number)) ? ((int)substr($deal_agreement_number->agreement_number, 0, -6)) : 0) + 1;

        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal')))
            $dealFiles = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/deal'));

        return view('forthebuilder::deal.create-from-booking', [
            'houses' => $houses,
            'booking' => $booking,
            'agreement_number_increment' => $agreement_number_increment,
            'dealFiles' => $dealFiles ?? '',
            'all_notifications' => $this->getNotification()
        ]);
    }

    // public function generateContract(Request $request,$id)
    // {
    //     $model = Deal::findOrFail($id);
    //     $month = StaticFunctions::getMonth(date('m',strtotime($model->dateDl)));
    //     $price_word = StaticFunctions::convertNumberToWord($model->house_flat->price);
    //     $headers = [
    //         "Content-type"=>"text/html",
    //         "Content-Disposition"=>"attachment;Filename=".$model->id.".doc"
    //     ];

    //     return Response::make(view('forthebuilder::deal.contract', [
    //         'model' => $model,
    //         'month' => $month,
    //         'price_word' => $price_word,
    //     ]),200, $headers);
    // }


}