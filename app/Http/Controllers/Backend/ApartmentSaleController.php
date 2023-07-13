<?php

namespace App\Http\Controllers\Backend;

use App\components\ImageResize;
use App\components\StaticFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentSaleRequest;
use App\Models\ApartmentHas;
use App\Models\ApartmentHasApartmentSale;
use App\Models\ApartmentSale;
use App\Models\Area;
use App\Models\BuildingType;
use App\Models\ApartmentSaleContacts;
use App\Models\ApartmentSaleImages;
use App\Models\Category;
use App\Models\ObjectTable;
use App\Models\Region;
use App\Models\ThereIsNearby;
use App\Models\ThereIsNearbyApartmentSale;
use App\Models\Town;
use App\Traits\Observable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\ForTheBuilder\Entities\HouseDocument;

class ApartmentSaleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = ApartmentSale::with('main_image')->where('is_parser', null)->select('id','user_id','title','address','price', 'images','currency','olx_url')->orderBy('id','desc')->paginate(config('params.pagination'));
        return view('backend.apartment-sale.index',[
            'models' => $models
        ]);
    }










    public function parsingNumber($lang ,Request $request)
    {
        // return $request->element_id;

        $data["data"] = $request->all();
        $url = 'https://www.olx.uz/d/obyavlenie/prodaetsya-kvartira-po-horoshey-tsene-ID3aqym.html';
        $headers = array("Content-Type: application/json", "Accept: application/json");
        $response = $this->invokeCurlRequest('POST', $url, $headers, json_encode($data));
        // return response([
        //     'data' => $response,
        // ]);
    }







    
    public function invokeCurlRequest($type, $url, $headers, $post)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_INTERFACE, $interface);
        if ($type == "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        // print_r($post);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        // print_r($response);
        // exit();
        curl_close($ch);
        if ($err) {
            return [
                'success' => false,
                'message' => "cURL Error #:" . $err,
                'data' => [],
                'request' => json_decode($post, true),
                'response' => json_decode($response, true)
            ];
        }
        return [
            'success' => true,
            'message' => 'retrived',
            'data' => json_decode($response),
            'request' => json_decode($post, true),
            'response' => json_decode($response, true)
        ];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartments = ApartmentHas::all();
        $there_is_nearbies = ThereIsNearby::all();
        $region = Region::all();
        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'))) {
            $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        }
        // Log::channel('action_logs')->info("пользователь хочет создать новую квартиру");

        return view('backend.apartment-sale.create',[
            'apartments' => $apartments,
            'region' => $region,
            'there_is_nearbies' => $there_is_nearbies,
            'files_saved' => $files_saved ?? '',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($lang, ApartmentSaleRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        ($request->is_exchange === 'on') ? $data['is_exchange'] = 1 : $data['is_exchange'] = 0;
        ($request->is_furnished == 'on') ? $data['is_furnished'] = 1 : $data['is_furnished'] = 0;
        ($request->is_commission == 'on') ? $data['is_commission'] = 1 : $data['is_commission'] = 0;
        $data['user_id'] = Auth::user()->id;
        $data['type'] = json_encode($request->flat_types);
        $apartment_sale = ApartmentSale::create($data);
        $apartment_sale->apartment_has()->attach($data['apartment_has']);
        $apartment_sale->there_is_nearby()->attach($data['there_is_nearby']);
        $apartment_sale_contacts = new ApartmentSaleContacts();
        if($data['phone_number']||$data['additional_phone_number']||$data['first_name']||$data['last_name']||$data['surname']||$data['email']){
            $apartment_sale_contacts->first_name = $data['first_name'];
            $apartment_sale_contacts->last_name = $data['last_name'];
            $apartment_sale_contacts->surname = $data['surname'];
            if($data['phone_number']){
                $apartment_sale_contacts->phone_number = $data['phone_code'] . $data['phone_number'];
            }
            if($data['additional_phone_number']){
                $apartment_sale_contacts->additional_phone_number = $data['phone_code2'] . $data['additional_phone_number'];
            }
            $apartment_sale_contacts->email = $data['email'];
            $apartment_sale->contacts()->save($apartment_sale_contacts);
        }

        //=================== file yuklanyapti ===================
        if (!file_exists(public_path('uploads/apartment-sale/'.$apartment_sale->id))) {
            $path = public_path('uploads/apartment-sale/'.$apartment_sale->id);
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if (!file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'))) {
            $path = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale');
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        $j = 0;
        foreach ($files_saved as $files_savedItem) {
            $j++;
            $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$files_savedItem->getFilename());
            $filenamehash = md5($files_savedItem->getFilename().time()).'.'.$files_savedItem->getExtension();
            $filesize =  File::size($sourcePath);

            $pathInfo = pathinfo($sourcePath);
            if ($pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'JPG' || $pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'PNG' || $pathInfo['extension'] == 'jpeg' || $pathInfo['extension'] == 'JPEG'){
                $imageR = new ImageResize($sourcePath);
                $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/apartment-sale/' . $apartment_sale->id.'/l_'.$filenamehash));
                $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/apartment-sale/' . $apartment_sale->id.'/m_'.$filenamehash));
                $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/apartment-sale/' . $apartment_sale->id.'/s_'.$filenamehash));

            }else{
                $storageDestinationPath = public_path('uploads/apartment-sale/' . $apartment_sale->id.'/'.$filenamehash);
                File::move($sourcePath,$storageDestinationPath);
            }

            ApartmentSaleImages::create([
                'apartment_sale_id' => $apartment_sale->id,
                'name' => $files_savedItem->getFilename(),
                'guid' => $filenamehash,
                'ext' => $files_savedItem->getExtension(),
                'size' => $filesize ?? '',
                'main_image'=> $j == 1 ? 1 : 0,
            ]);

            File::delete($sourcePath);
        }
        //=================== file yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================

        Log::channel('action_logs')->info("пользователь создал новую квартиру : " . $apartment_sale->title."",['info-data'=>$apartment_sale]);

        return redirect()->route('apartment-sale.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApartmentSale  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $model = ApartmentSale::findOrFail($id);
        Log::channel('action_logs')->info("пользователь показал ".$model->title." квартиру",['info-data'=>$model]);
        return view('backend.apartment-sale.show',[
            'model' => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApartmentSale  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {

        $model = ApartmentSale::findOrFail($id);
        $region = Region::all();
        $apartments = ApartmentHas::all();
        $there_is_nearbies = ThereIsNearby::all();
        $parent = ObjectTable::all();
        $region = Region::all();
        $category = Category::all();
        if ($model->region_id != Region::TASHKENT) {
            $town = Town::where('region_id', $model->region_id)->get();
            $area = Area::where('town_id', $model->town_id)->get();
        } else {
            $area = Town::where('region_id', $model->region_id)->get();
            $town = [];
        }
        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'))) {
            $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        }
        Log::channel('action_logs')->info("пользователь собирается обновить ".$model->title." распродажу квартиру",['info-data'=>$model]);

        return view('backend.apartment-sale.edit',[
            'model' => $model,
            'apartments' => $apartments,
            'parent' => $parent,
            'region' => $region,
            'category' => $category,
            'town' => $town,
            'area' => $area,
            'there_is_nearbies' => $there_is_nearbies,
            'files_saved' => $files_saved ?? '',
            'tashkent_region' => Region::TASHKENT
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApartmentSale  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function update($lang, ApartmentSaleRequest $request, $id)
    {
        $data = $request->validated();
        $model = ApartmentSale::findOrFail($id);
        ($request->is_exchange === 'on') ? $model['is_exchange'] = 1 : $model['is_exchange'] = 0;
        ($request->is_furnished === 'on') ? $model['is_furnished'] = 1 : $model['is_furnished'] = 0;
        ($request->is_commission === 'on') ? $model['is_commission'] = 1 : $model['is_commission'] = 0;

        if ($request->is_commission === 'on'){
            $model->is_commission_percent = $data['is_commission_percent'];
            $model->is_commission_number = $data['is_commission_number'];
        }else{
            $model->is_commission_percent = '';
            $model->is_commission_number = '';
        }
        if(!$model->user_id){
            $model['user_id'] = Auth::user()->id;
        }
        $data['type'] = json_encode($request->flat_types);
        $model->type = $data['type'];
        $model->title = $data['title'];
        $model->description = $data['description'];
        $model->address = $data['address'];
        $model->region_id = $data['region_id'];
        $model->town_id = $data['town_id'];
        $model->area_id = $data['area_id'];
        $model->total_area = $data['total_area'];
        $model->living_space = $data['living_space'];
        $model->kitchen_area = $data['kitchen_area'];
        $model->floor = $data['floor'];
        $model->floors_of_house = $data['floors_of_house'];
        $model->number_of_rooms = $data['number_of_rooms'];
        $model->ceiling_height = $data['ceiling_height'];
        $model->year_construction = $data['year_construction'];

        $model->price = $data['price'];

        $model->currency = $data['currency'];
        $model->repair = $data['repair'];
        $model->layout = $data['layout'];
        $model->bathroom = $data['bathroom'];
        $model->building_type = $data['building_type'];
        $model->housing_type = $data['housing_type'];
        $model->distance_to_metro = $data['distance_to_metro'];
        $model->metro = $data['metro'];
        $model->latitude = $data['latitude'];
        $model->longitude = $data['longitude'];
        $model->save();

        $model->apartment_has()->sync($data['apartment_has']);
        $model->there_is_nearby()->sync($data['there_is_nearby']);

        $contacts = $model->contacts;
        if (!empty($contacts)){
            $contacts->first_name = $data['first_name'];
            $contacts->last_name = $data['last_name'];
            $contacts->surname = $data['surname'];
            $contacts->phone_number = $data['phone_number'];
            $contacts->additional_phone_number = $data['additional_phone_number'];
            $contacts->email = $data['email'];
            $model->contacts()->save($contacts);
        }else{
            $contacts = new ApartmentSaleContacts();
            $contacts->first_name = $data['first_name'];
            $contacts->last_name = $data['last_name'];
            $contacts->surname = $data['surname'];
            $contacts->phone_number = $data['phone_number'];
            $contacts->additional_phone_number = $data['additional_phone_number'];
            $contacts->email = $data['email'];
            $model->contacts()->save($contacts);
        }

        if (!file_exists(public_path('uploads/apartment-sale/'.$model->id))) {
            $path = public_path('uploads/apartment-sale/'.$model->id);
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if (!file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'))) {
            $path = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale');
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        $j = 0;
        foreach ($files_saved as $files_savedItem) {
            $j++;
            $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$files_savedItem->getFilename());
            $filenamehash = md5($files_savedItem->getFilename().time()).'.'.$files_savedItem->getExtension();
            $filesize =  File::size($sourcePath);

            $pathInfo = pathinfo($sourcePath);
            if ($pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpeg'){
                $imageR = new ImageResize($sourcePath);
                $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/apartment-sale/' . $model->id.'/l_'.$filenamehash));
                $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/apartment-sale/' . $model->id.'/m_'.$filenamehash));
                $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/apartment-sale/' . $model->id.'/s_'.$filenamehash));

            }else{
                $storageDestinationPath = public_path('uploads/apartment-sale/' . $model->id.'/'.$filenamehash);
                File::move($sourcePath,$storageDestinationPath);
            }

            ApartmentSaleImages::create([
                'apartment_sale_id' => $model->id,
                'name' => $files_savedItem->getFilename(),
                'guid' => $filenamehash,
                'ext' => $files_savedItem->getExtension(),
                'size' => $filesize ?? '',
                'main_image'=> $j == 1 ? 1 : 0,
            ]);

            File::delete($sourcePath);
        }

        Log::channel('action_logs')->info("пользователь обновил ".$model->title." квартиру",['info-data'=>$model]);
        return redirect()->route('apartment-sale.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApartmentSale  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $apartment_sale = ApartmentSale::findOrFail($id);
        $apartment_sale->apartment_has()->detach();
        $apartment_sale->there_is_nearby()->detach();
        $apartment_sale->contacts()->delete();
        $model = ApartmentSaleImages::where('apartment_sale_id', $apartment_sale->id)->first();
        if(isset($model) && $model->guid){
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/'.$model->guid));
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/l_'.$model->guid));
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/m_'.$model->guid));
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/s_'.$model->guid));
            $model->delete();
        }
        $apartment_sale->delete();
        Log::channel('action_logs')->info("пользователь удалил ".$apartment_sale->title." квартиру",['info-data'=>$apartment_sale->description]);
        return back()->with('success', __('locale.deleted'));
    }
    public function alldestroy()
    {
        $apartment_sale = ApartmentSale::select('id')->get();
        $id_array = [];
        foreach($apartment_sale as $apartment){
            $id_array[] = $apartment->id;
        }
        unset($id_array[array_search(10, $id_array)]);
        unset($id_array[array_search(11, $id_array)]);
        foreach ($id_array as $id_a){
            $apartment_d = ApartmentSale::find($id_a);
            $apartment_d->apartment_has()->detach();
            $apartment_d->there_is_nearby()->detach();
            $apartment_d->contacts()->delete();
            $apartment_d->delete();
        }
        Log::channel('action_logs')->info("пользователь удалено квартиры");
        return back()->with('success', __('locale.deleted'));
    }

    public function destroyMultiple($lang, Request $request)
    {
        $data_ids = $request->ids;
        if ($data_ids) {
            DB::table("real_estate")->whereIn('id',explode(",",$data_ids))->delete();
            return response()->json(['success'=>"успешно удален"]);
        }

    }


    public function destroy_img_item($lang, Request $request, $id)
    {
        if($request->ajax()) {
            $model = ApartmentSaleImages::findOrFail($id);
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/'.$model->guid));
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/l_'.$model->guid));
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/m_'.$model->guid));
            File::delete(public_path('uploads/apartment-sale/'.$model->apartment_sale_id.'/s_'.$model->guid));
            $model->delete();
            return response()->json([
                'success' => __('locale.deleted')
            ]);
        }
    }

    public function destroy_img_cron($lang, Request $request, $id)
    {
        if($request->ajax()) {
            $model = ApartmentSale::findOrFail($request->flatid);
            $flat_images = [];
            if(!is_array($model->images)){
                return response()->json(json_decode($model->images));
                $flat_images = json_decode($model->images);
                $k_image = array_search($request->image, json_decode($model->images));
            }else{
                $flat_images = $model->images;
                $k_image = array_search($request->image, $model->images);
            }
            unset($flat_images[$k_image]);
            $model->images = json_encode($flat_images);
            $model->save();
            return response()->json([
                'success' => __('locale.deleted')
            ]);
        }
    }

    //==================== kartik fileinput resource/apartment-sale/create scripts dagi fileinputga qara ==================================
    public function fileUpload($lang, Request $request)
    {
        return StaticFunctions::fileUploadKartikWithAjax($request,'real-estate','apartment-sale');
    }

    public function fileDelete($lang, Request $request, $key)
    {
        $filePath = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$key);
        return File::delete($filePath);
    }

    public function fileDeleteAll($lang, Request $request)
    {
        // dd('fileDeleteAll');
        File::deleteDirectory(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        return response()->json('successfully');
    }


    public function fileSort($lang, Request $request)
    {
        $arr1 = $request->all();
        // dd($arr1);
        // $datastack = $arr1['files'];
        // dd($datastack);
        $oldIndex = $arr1['oldIndex'];
        $newIndex = $arr1['newIndex'];
        // $newArray = array();


        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'))) {
            $files_saved1 = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        }

        foreach($files_saved1 as $files_savedItem1){
            $strTitle1 = substr($files_savedItem1->getFilename(), 0, strpos($files_savedItem1->getFilename(), '_'));
            // if($strTitle1 == ''){
            //     return response()->json(['warnings' =>'file not found']);
            // }
            if($oldIndex == $strTitle1){
                // dd($strTitle1);
                $oldFile1 = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$files_savedItem1->getFilename());
                // if(empty($oldFile1)){
                //     return response()->json(['warnings' =>'file not found']);
                // }
                $newFileUrl1 = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale');

                $strT = substr($files_savedItem1->getFilename(), strpos($files_savedItem1->getFilename(), '_')+1, strlen($files_savedItem1->getFilename()));

                $newFile1 = $newFileUrl1.'/'.$newIndex.'-_'.$strT;
                File::move($oldFile1,$newFile1);



                $files_saved_new = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
                // dd($files_saved_new);
                $z = 0;
                foreach($files_saved_new as $files_savedItem){
                    $oldFile = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$files_savedItem->getFilename());
                    $newFileUrl = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale');

                    $strTitle = substr($files_savedItem->getFilename(), strpos($files_savedItem->getFilename(), '_')+1, strlen($files_savedItem->getFilename()));
                    // $forNewArr = $z.'_'.$strTitle;
                    $newFile = $newFileUrl.'/'.$z.'_'.$strTitle;
                    File::move($oldFile,$newFile);
                    $z++;
                    // $newArray[] = $forNewArr;
                }
            }

        }



        // $files_in_the_datastack = array();
        // foreach ($datastack as $itemDatastack) {

        //     $files_in_the_datastack[] = $itemDatastack['caption'];


        // }

        // $files_savedArr = array();
        // foreach ($files_saved as $itemfff) {

        //     $files_savedArr[] = $itemfff->getFilename();


        // }
        // $result = array_keys(array_diff_assoc($files_savedArr,$files_in_the_datastack));
        // dd($result,$files_savedArr,$files_in_the_datastack);










        // if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'))) {
        //     $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        // }

        // $z = 0;
        // foreach($files_saved as $files_savedItem){
        //     $oldFile = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$files_savedItem->getFilename());
        //     $newFileUrl = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale');

        //     $strTitle = substr($files_savedItem->getFilename(), strpos($files_savedItem->getFilename(), '_')+1, strlen($files_savedItem->getFilename()));
        //     $newFile = $newFileUrl.'/'.$z.'_'.$strTitle;
        //     File::move($oldFile,$newFile);
        //     $z++;
        // }














        // if(!empty($files_saved)){
        //     for($k = 0; $k < count($datastack); $k++) {

        //         foreach($files_saved as $files_savedItem){
        //             if($files_savedItem->getFilename() == $datastack[$k]['caption']){

        //                 $oldFile = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$datastack[$k]['caption']);
        //                 $newFileUrl = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale');

        //                 $strTitle = substr($datastack[$k]['caption'], strpos($datastack[$k]['caption'], '_')+1, strlen($datastack[$k]['caption']));
        //                 // dd($strTitle);

        //                 // $newFile = '';
        //                 // if(){

        //                     $newFile = $newFileUrl.'/'.$k.'_'.$strTitle;
        //                     // dd($newFile);
        //                 // }else{}

        //                 File::move($oldFile,$newFile);
        //             }
        //         }


        //         // $k++;
        //         // dd($newFile.'/'.$datastack[$k]['caption'],$oldFile );
        //     }

        // }


        // $i = 0;
        // foreach($datastack as $file) {
        //     $oldFile = public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale/'.$file['caption']);

        //     $oldFileStrLen= strlen($file['caption']);
        //     $newIndexFile = substr($file['caption'], strpos($file['caption'], '_')+1, $oldFileStrLen);

        //     $newFileName = $i.'_'.$newIndexFile;



        //     File::move($oldFile,$newFile.'/'.$newFileName);
        //     $i++;
        //         $newArray[] = $newFileName;
        //         // $newArray['key'] = $newFileName;
        //         // $newArray['size'] = $file['size'];
        //         // $newArray['type'] = $file['type'];
        //         // $newArray['url'] = '/real-estate/apartment-sale/file-delete/'. $newFileName;
        //         // $newArray['width'] = $file['width'];
        // }

        // return response()->json(['success' => 'success','images'=>$newArray]);
        return response()->json(['success' => 'success']);

    }
    //==================== yakunladni kartik fileinput resource/apartment-sale/create scripts dagi fileinputga qara ==================================



}
