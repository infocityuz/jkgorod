<?php

namespace Modules\ForTheBuilder\Http\Controllers;

use Illuminate\Http\Request;
use App\components\ImageResize;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\components\StaticFunctions;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Modules\ForTheBuilder\Entities\Booking;
use Modules\ForTheBuilder\Entities\Constants;
use Modules\ForTheBuilder\Entities\Coupon;
use Modules\ForTheBuilder\Entities\Currency;
use Modules\ForTheBuilder\Entities\Deal;
use Modules\ForTheBuilder\Entities\House;
use Modules\ForTheBuilder\Entities\HouseFlat;
use Modules\ForTheBuilder\Entities\HouseDocument;
use Modules\ForTheBuilder\Entities\Notification_;
use Modules\ForTheBuilder\Http\Requests\HouseRequest;
use Modules\ForTheBuilder\Http\Requests\HouseFlatRequest;
use Carbon\Carbon;


class HouseFlatController extends Controller
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
        $models = HouseFlat::orderBy('id', 'desc')->paginate(config('params.pagination'));
        return view('forthebuilder::house-flat.index', [
            'models' => $models,
            'all_notifications' => $this->getNotification()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = HouseFlat::all();
        $houses = House::all();

        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/house-flat'))) {
            $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/house-flat'));
        }

        return view('forthebuilder::house-flat.create', [
            'models' => $models,
            'houses' => $houses,
            'files_saved' => $files_saved ?? '',
            'all_notifications' => $this->getNotification()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(HouseFlatRequest $request)
    {
        $data = $request->validated();
        $number_of_flat = HouseFlat::where([
            'house_id' => $data['house_id'],
            'number_of_flat' => $data['number_of_flat'],
        ])->first();
        $contract_number = HouseFlat::where([
            'house_id' => $data['house_id'],
            'contract_number' => $data['contract_number'],
        ])->first();
        if (isset($number_of_flat)) {
            return redirect()->back()->with('fail', __('locale.This flat number is exist'));
        }
        if (isset($contract_number)) {
            return redirect()->back()->with('fail', __('locale.This contract number is exist'));
        }
        $model = HouseFlat::create($data);

        //=================== file yuklanyapti ===================
        if (!file_exists(public_path('uploads/house-flat/' . $model->id))) {
            $path = public_path('uploads/house-flat/' . $model->id);
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/house-flat'));
        $j = 0;
        foreach ($files_saved as $files_savedItem) {
            $j++;
            $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id . '/house-flat/' . $files_savedItem->getFilename());
            $filenamehash = md5($files_savedItem->getFilename() . time()) . '.' . $files_savedItem->getExtension();
            $filesize =  File::size($sourcePath);

            $pathInfo = pathinfo($sourcePath);
            if ($pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpeg') {
                $imageR = new ImageResize($sourcePath);
                $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/house-flat/' . $model->id . '/l_' . $filenamehash));
                $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/house-flat/' . $model->id . '/m_' . $filenamehash));
                $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/house-flat/' . $model->id . '/s_' . $filenamehash));
            } else {
                $storageDestinationPath = public_path('uploads/house-flat/' . $model->id . '/' . $filenamehash);
                File::move($sourcePath, $storageDestinationPath);
            }

            HouseDocument::create([
                'house_flat_id' => $model->id,
                'name' => $files_savedItem->getFilename(),
                'guid' => $filenamehash,
                'ext' => $files_savedItem->getExtension(),
                'size' => $filesize ?? '',
                'main_image' => $j == 1 ? 1 : 0,
            ]);

            File::delete($sourcePath);
        }
        //=================== file yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================


        Log::channel('action_logs2')->info("пользователь создал новую Дом  : ", ['info-data' => $model]);

        return redirect()->route('forthebuilder.house.show-more', $data['house_id'])->with('success', __('locale.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = HouseFlat::findOrFail($id);
        $currency = Currency::first();
        // $coupon = Coupon::all();
        // pre($model);
        return view('forthebuilder::house-flat.show', [
            'model' => $model,
            'currency' => $currency,
            'status' => '',
            'all_notifications' => $this->getNotification()
            // 'coupon' => $coupon,
        ]);
    }

    public function showMore($id)
    {
        $model = HouseFlat::findOrFail($id);
        $houses = HouseFlat::where('number_of_flat', $model->number_of_flat)->get();

        return view('forthebuilder::house-flat.show-more', [
            'model' => $model,
            'houses' => $houses,
            'all_notifications' => $this->getNotification()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $model = HouseFlat::findOrFail($id);
        $houses = House::all();

        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/house-flat'))) {
            $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/house-flat'));
        }

        // pre($files_saved);
        return view('forthebuilder::house-flat.edit', [
            'model' => $model,
            'houses' => $houses,
            'files_saved' => $files_saved ?? '',
            'all_notifications' => $this->getNotification()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(HouseFlatRequest $request, $id)
    {
        $data = $request->validated();
        $dirname = dirname(__FILE__);

        // dd($data);
        $model = HouseFlat::findOrFail($id);
        $model->number_of_flat = $data['number_of_flat'];
        $model->entrance = $data['entrance'];
        $model->floor = $data['floor'];
        $model->doc_number = $data['doc_number'];

        $price = ((($data['price'] ?? 0) * ($data['area_total'] ?? 0)) + (($data['price_basement'] ?? 0) * ($data['area_basement'] ?? 0)) + (($data['price_attic'] ?? 0) * ($data['area_attic'] ?? 0)));
        $model->price = $price;

        // dd($data);
        $area = [
            'housing' => $data['area_housing'] ?? 0,
            'total' => $data['area_total'] ?? 0,
            'basement' => $data['area_basement'] ?? 0,
            "hotel" => $data['area_hotel'] ?? 0,
            "bedroom" => $data['area_bedroom'] ?? 0,
            'terraca' => $data['area_terraca'] ?? 0,
            'attic' => $data['area_attic'] ?? 0,
            'balcony' => $data['area_balcony'] ?? 0,
            'kitchen' => 0,
        ];
        $model->areas = json_encode($area);

        $area_price = [
            'hundred' => [
                'total' => $data['price'] ?? 0,
                'basement' => $data['price_basement'] ?? 0,
                'attic' => $data['price_attic'] ?? 0,
                'terraca' => $data['price_terrace'] ?? 0,
            ],

            'thirty' => [
                'total' => $data['price_30'] ?? 0,
                'basement' => $data['price_basement_30'] ?? 0,
                'attic' => $data['price_attic_30'] ?? 0,
                'terraca' => $data['price_terrace_30'] ?? 0,
            ],

            'fifty' => [
                'total' => $data['price_50'] ?? 0,
                'basement' => $data['price_basement_50'] ?? 0,
                'attic' => $data['price_attic_50'] ?? 0,
                'terraca' => $data['price_terrace_50'] ?? 0,
            ],
        ];
        $model->ares_price = json_encode($area_price);

        $model->save();
        
        if (!file_exists($dirname . '/../../../../public/uploads/house-flat' . $model->house_id)) {
            // $ =  . $model->id;
            $path = $dirname . '/../../../../public/uploads/house-flat/' . $model->house_id;
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        // uploads/tmp_files/
        // if (file_exists($dirname . '/../../../../public/uploads/tmp_files/' . Auth::user()->id . '/house-flat')) {
        //     $files_saved = File::allFiles($dirname . '/../../../../public/uploads/tmp_files/' . Auth::user()->id . '/house-flat');
        //     $j = 0;
        //     foreach ($files_saved as $files_savedItem) {
        //         $j++;
        //         $sourcePath = $dirname . '/../../../../public/uploads/tmp_files/' . Auth::user()->id . '/house-flat/' . $files_savedItem->getFilename();
        //         $filenamehash = md5($files_savedItem->getFilename() . time()) . '.' . $files_savedItem->getExtension();
        //         $filesize =  File::size($sourcePath);


        //         $pathInfo = pathinfo($sourcePath);
        //         if ($pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpeg') {
        //             $imageR = new ImageResize($sourcePath);
        //             $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/house-flat/' . $model->house_id . '/l_' . $filenamehash));
        //             $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/house-flat/' . $model->house_id . '/m_' . $filenamehash));
        //             $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/house-flat/' . $model->house_id . '/s_' . $filenamehash));
        //         } else {
        //             $storageDestinationPath = public_path('uploads/house-flat/' . $model->house_id . '/' . $filenamehash);
        //             File::move($sourcePath, $storageDestinationPath);
        //         }

        //         HouseDocument::create([
        //             'house_flat_id' => $model->id,
        //             'name' => $files_savedItem->getFilename(),
        //             'guid' => $filenamehash,
        //             'ext' => $files_savedItem->getExtension(),
        //             'size' => $filesize ?? '',
        //             'main_image' => $j == 1 ? 1 : 0,
        //         ]);

        //         File::delete($sourcePath);
        //     }
        // }

        $image = $data['files'] ?? '';
        if (!empty($image)) {
            $imageName = md5(time().$image).'.'.$image->getClientOriginalExtension();
            $data['files'] = $imageName;
        }

        if (!empty($image)) {
            //bu yerda orginal rasm yuklanyapti ochilgan papkaga
            // dd($dirname . '/../../../../public/uploads/house-flat/' . $model->house_id . ' ,,, ' . $imageName);
            $image->move(public_path('uploads/house-flat/' . $model->house_id),$imageName);

            //bu yerda orginal rasm  app/components/imageresize.php fayliga kesiladigan rasm manzili ko'rsatilyapti
            $imageR = new ImageResize( public_path('uploads/house-flat/' . $model->house_id . '/' . $imageName));
            // dd($imageR);

            //bu yerda orginal rasm  app/components/imageresize.php fayli orqali kesilyapti
            $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.width'))->save(public_path('uploads/house-flat/' . $model->house_id . '/s_' . $imageName));
            $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.width'))->save(public_path('uploads/house-flat/' . $model->house_id . '/m_' . $imageName));
            $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.width'))->save(public_path('uploads/house-flat/' . $model->house_id . '/l_' . $imageName));
            //bu yerda orginal rasm  o'chirilyapti.chunki endi bizga kerakmas orginali biz o'zimizga kerkligicha kesib oldik

            // $oldHouseDoc = HouseDocument::where('house_flat_id', $model->id)->first();
            $oldHouseDoc = HouseDocument::firstOrCreate(['house_flat_id' => $model->id]);
            $oldHouseDoc->guid = $imageName;
            $oldHouseDoc->save();
            // [
            //     'house_flat_id' => $model->id,
            //     'name' => $files_savedItem->getFilename(),
            //     'guid' => $filenamehash,
            //     'ext' => $files_savedItem->getExtension(),
            //     'size' => $filesize ?? '',
            //     'main_image' => $j == 1 ? 1 : 0,
            // ]);

            File::delete(public_path('uploads/house-flat/' . $model->house_id.'/'.$imageName));

        }


        Log::channel('action_logs2')->info("пользователь обновил Дом", ['info-data' => $model]);
        return redirect()->route('forthebuilder.house-flat.show', $id)->with('success', __('locale.successfully'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'integer|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json($validator);
        }
        if ($request->ajax()) {
            $model = HouseFlat::findOrFail($id);

            if (Gate::allows('isAdmin')) {
                // if ($model->status == Constants::STATUS_BOOKING) {
                //     $existBooking = Booking::where(['house_flat_id' => $id, 'status' => Constants::BOOKING_ACTIVE])->first();
                //     if (isset($existBooking)) {
                //         $existBooking->status = Constants::BOOKING_ARCHIVE;
                //         $existBooking->save();
                //     }
                // }
                $model->status = Constants::STATUS_FREE;
                $model->save();

                $existBooking = Booking::where('house_flat_id', $model->id)->delete();

                $modeDeal = Deal::where('house_flat_id', $model->id)->delete();
            } else {
                return response()->json([
                    'warning' => 'только админ может изменить'
                ]);
            }

            return response()->json([
                'id' => $id,
                'status' => $model->status,
                'success' => 'Статус измeнён',
                'all_notifications' => $this->getNotification()
            ]);
        }
    }

    //==================== kartik fileinput resource/house-flat/create scripts dagi fileinputga qara ==================================
    public function fileUpload(Request $request)
    {
        return StaticFunctions::fileUploadKartikWithAjax($request, 'forthebuilder', 'house-flat');
    }


    // public function fileRenameForSort(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //          dd("True request!");
    //     }
    //     // dd($request->all());
    //     // if ($request->ajax()) {
    //     //     // dd(response()->json($request->all()));
    //     //     dd($request->all());
    //     // }
    //     // $filePath = public_path('/uploads/tmp_files/' . Auth::user()->id.'/house-flat/'.$key);
    //     // $fileRename = public_path('/uploads/tmp_files/' . Auth::user()->id.'/house-flat/'.$key);

    //     // return rename($filePath, $fileRename);
    // }

    public function fileDelete(Request $request, $key)
    {
        $filePath = public_path('/uploads/tmp_files/' . Auth::user()->id . '/house-flat/' . $key);
        return File::delete($filePath);
    }

    //==================== yakunladni kartik fileinput resource/house-flat/create scripts dagi fileinputga qara ==================================

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = HouseFlat::findOrFail($id);

        $HouseDocuments = HouseDocument::where('house_flat_id', $id)->get();

        foreach ($HouseDocuments as $HouseDocument) {
            File::delete(public_path('uploads/house-flat/' . $HouseDocument->deal_id . '/l_' . $HouseDocument->guid));
            File::delete(public_path('uploads/house-flat/' . $HouseDocument->deal_id . '/s_' . $HouseDocument->guid));
            File::delete(public_path('uploads/house-flat/' . $HouseDocument->deal_id . '/m_' . $HouseDocument->guid));
            $HouseDocument->delete();
        }
        $id = $model->house_id;
        $model->delete();
        Log::channel('action_logs2')->info("пользователь удалил Дом", ['info-data' => $model]);
        // return back()->with('success', __('locale.deleted'));
        return redirect()->route('forthebuilder.house.show-more', $id)->with('deleted', translate('Data deleted successfuly'));
    }

    public function destroy_file_item(Request $request, $id)
    {
        if ($request->ajax()) {
            $model = HouseDocument::findOrFail($id);
            File::delete(public_path('uploads/house-flat/' . $model->house_flat_id . '/' . $model->guid));
            $model->delete();
            return response()->json([
                'success' => __('locale.deleted')
            ]);
        }
    }

    public function printPdf(Request $request, $id)
    {
        $model = HouseFlat::findOrFail($id);
        $currency = [];
        if ($request->USD && $request->SUM) {
            $currency['USD'] = floatval($request->USD);
            $currency['SUM'] = intval($request->SUM);
        } else {
            $currencies = Currency::first();
            $currency['USD'] = $currencies->USD;
            $currency['SUM'] = $currencies->SUM;
        }
        $pdf = Pdf::loadView('forthebuilder::house-flat.printPdf', [
            'model' => $model,
            'currency' => $currency,
            'date' => $request->date_picker,
            'coupon' => $request->coupon,
            'coupon_percent' => $request->coupon_percent,
        ]);
        //return $pdf->download('house.pdf');
        $data_time = date('Y-m-d h:m:s');
        return $pdf->download($data_time . '-.pdf');
        //        return $pdf->stream();
    }

    public function print(Request $request, $id)
    {
        // dd($request->all());
        $model = HouseFlat::findOrFail($id);
        $house=House::where('id',$model->house_id)->first();
        $guid=HouseDocument::where('house_flat_id',$model->id)->first()->guid ?? null;
        $data_time = date('Y-m-d h:m:s');
        // $data_time = date('Y-m-d h:m:s');
        $day_two_week=Carbon::now()->addDay(14)->format('d-m-Y');
        // $date_picker=$request->date_picker;
        $date_picker=Carbon::parse($request->date_picker)->format('d-m-Y');
        // $date=$date_picker->format('d-m-Y');
        // dd($date_picker);

        $user= Auth::user();
        $user_name=$user->first_name;
        // dd($user_name); 
        // echo "<pre>";
        return view('forthebuilder::house-flat.print', [
            'model' => $model,
            // 'currency' => $currency,
            'date' => $date_picker,
            'day_two_week'=>$day_two_week,
            'house'=>$house,
            'guid'=>$guid,
            'user_name'=>$user_name,
            'coupon' => $request->coupon,
            'coupon_percent' => $request->coupon_percent,
            'all_notifications' => $this->getNotification()
        ]);
        // print_r($pdf);
        // dd($pdf);

        // return $pdf->download($data_time . '-.pdf');
        //        return $pdf->stream();
    }

    public function searchCoupon($text)
    {
        $model = Coupon::select('name', 'percent')->where('name', $text)->first();
        return $model;
    }
}
