<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\components\ImageResize;
use App\components\StaticFunctions;
use App\Http\Requests\ApartmentSaleRequest;
use App\Models\ApartmentHas;
use App\Models\ApartmentHasApartmentSale;
use App\Models\ApartmentSale;
use App\Models\BuildingType;
use App\Models\ApartmentSaleContacts;
use App\Models\ApartmentSaleImages;
use App\Models\ThereIsNearby;
use App\Models\ThereIsNearbyApartmentSale;
use App\Traits\Observable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\ForTheBuilder\Entities\HouseDocument;

class ParserController extends Controller
{
    public $stopParsing = 0;
    public $price_from;
    public $price_to;
    public $rooms_from;
    public $rooms_to;
    public $area_from;
    public $area_to;
    public $floor_from;
    public $floor_to;
    public $found_f;
    public $housing_type;
    public $commission;
    public $furnished;
    public $business_private;

    public function index()
    {
        $models = ApartmentSale::with('main_image')->where('is_parser', 1)->select('id','user_id','title','address','price', 'images','currency')->orderBy('id','desc')->paginate(config('params.pagination'));
        return view('backend.parser.index',[
            'models' => $models
        ]);
    }
    public function show($lang, $id)
    {
        $model = ApartmentSale::findOrFail($id);
        Log::channel('action_logs')->info("пользователь показал ".$model->title." квартиру",['info-data'=>$model]);
        return view('backend.parser.show',[
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
        $apartments = ApartmentHas::all();
        $there_is_nearbies = ThereIsNearby::all();
        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'))) {
            $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        }
        Log::channel('action_logs')->info("пользователь собирается обновить ".$model->title." распродажу квартиру",['info-data'=>$model]);
        return view('backend.parser.edit',[
            'model' => $model,
            'apartments' => $apartments,
            'there_is_nearbies' => $there_is_nearbies,
            'files_saved' => $files_saved ?? '',
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

        $model['user_id'] = Auth::user()->id;

        $model->type = $data['type'];
        $model->title = $data['title'];
        $model->description = $data['description'];
        $model->address = $data['address'];
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
                'main_image'=> $j == 0,
            ]);

            File::delete($sourcePath);
        }

        Log::channel('action_logs')->info("пользователь обновил ".$model->title." квартиру",['info-data'=>$model]);
        return redirect()->route('parser.index', app()->getLocale())->with('success', __('locale.successfully'));
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
        $apartment_sale->forceDelete();
        Log::channel('action_logs')->info("пользователь удалил ".$apartment_sale->title." квартиру",['info-data'=>$apartment_sale->description]);
        return back()->with('success', __('locale.deleted'));
    }
    public function alldestroy()
    {
        $apartment_sale = ApartmentSale::where('is_parser', 1)->get();
        foreach ($apartment_sale as $apart_sale){
            $apartment_d = ApartmentSale::find($apart_sale->id);
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
        return response()->json(['success' => 'success']);
    }

    public function countFlats(){
        $count = count(ApartmentSale::where('is_parser', 1)->get());
        return response()->json($count);
    }
    public function reloadPage(){
        return redirect()->route('parser.index', app()->getLocale())->with('confirm', 'confirmed');
    }

    public function toApartment($lang, $id){
        $model = ApartmentSale::find($id);
        $model->is_parser = NULL;
        $model->save();
        return redirect()->route('parser.index', app()->getLocale())->with('success', __('locale.The apartment has been successfully transferred to the category of apartments for sale'));
    }

    public function olxFlatDelete(){
        $models = ApartmentSale::all();
        foreach ($models as $model){
            if($model->olx_url){
                if(!file_get_contents($model->olx_url)){
                    if($model->id != 10 && $model->id != 11){
                        $model->delete();
                    }
                }
            }
        }
    }

    public function parsing($url, $flat_type)
    {
        date_default_timezone_set("Asia/Tashkent");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $htmls = curl_exec($ch);
        $html_array = explode('css-wsrviy', $htmls);
        $html = $html_array[0];
        $dom = new \DOMDocument();
        if(isset($html)){
            @ $dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);
            $flats_url = $xpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-88vtd4']//div[@class='css-1d90tha']//div[@class='css-1sw7q4x']//a[@class='css-rc5s2u']");
            $found_flats = $xpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-88vtd4']//div[@class='css-x1jscs']//div[@class='css-n9feq4']//h3//div");
            $data = [];
            foreach ($found_flats as $found_flat){
                $this->found_f = $found_flat->textContent;
            }
            $j = 0;
            if((int)explode(' ', $this->found_f)){
                foreach($flats_url as $furl) {
                    $j = $j+1;
                    if($j < 12){
                        $apartment_sale = new ApartmentSale();
                        $apartment_sale_contacts = new ApartmentSaleContacts();
                        $oneFlat = curl_init();
                        $apartment_model = ApartmentSale::where('olx_url', str_replace(' ', '', "https://www.olx.uz".$furl->getAttribute('href')))->first();
                        if(!isset($apartment_model->id)){
                            curl_setopt($oneFlat, CURLOPT_URL, "https://www.olx.uz".$furl->getAttribute('href'));
                            curl_setopt($oneFlat, CURLOPT_RETURNTRANSFER, true);
                            $onehtml = curl_exec($oneFlat);
                            $onedom = new \DOMDocument();
                            if($onehtml) {
                                @ $onedom->loadHTML($onehtml);
                                $onexpath = new \DOMXPath($onedom);
//                                $flat_title = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//div[@class='css-n9feq4']//div[@class='css-1wws9er']//h1");
                                $flat_title = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//div[@class='css-1wws9er']//h1");
                                $flat_price = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//div[@class='css-n9feq4']//div[@class='css-dcwlyx']//h3");
                                $flat_adress = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//a[@class='css-tyi2d1']");
                                $flat_infos = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//ul[@class='css-sfcl1s']//p");
                                $oneimages = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//img");
                                $descriptions = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1m8mzwg']//div");
                                $seller_id = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-cgp8kk']//span");
                                $user_name = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-2f03k6']//div[@class='css-1fp4ipz']//h4");
                                $published = $onexpath->query("//body//div[@id='root']//div[@class='css-50cyfj']//div[@class='css-1qw98an']//div[@class='css-1d90tha']//div[@class='css-sg1fy9']//span");
                                $adress_count = count($flat_adress);
                                $adress_array = [];
                                $published_array = [];
                                foreach($user_name as $uname){
                                    $apartment_sale_contacts->first_name = $uname->textContent;
                                }
                                foreach ($flat_adress as $fadress) {
                                    $adress_array[] = $fadress->textContent;
                                }
                                foreach ($published as $publish) {
                                    $published_array[] = $publish->textContent;
                                }
                                $published_text = str_replace(' ', '', $published_array[1]);
                                $number_string = preg_replace("/[^0-9]/", '', $published_text);
                                if ((int)$number_string >2400){
                                    $apartment_sale->published = $published_array[1];
                                }else{
                                    $apartment_sale->published = date("d-M-Y");
                                }
                                $adress_region = explode('-', $adress_array[$adress_count - 2]);
                                $adress_city = explode('-', $adress_array[$adress_count - 1]);
                                $flatAddress = $adress_region[1] . ' ' . $adress_city[1];
                                foreach ($descriptions as $description) {
                                    $string_withouth_spaces = str_replace(' ', '', $description->textContent);
                                    $string_withouth_space = str_replace('-', '', $string_withouth_spaces);
                                    $number_string = preg_replace("/[^0-9]/", ' ', $string_withouth_space);
                                    $number_array = explode(' ', $number_string);
                                    foreach ($number_array as $number_key => $number_element) {
                                        if ($number_element == "") {
                                            unset($number_array[$number_key]);
                                        }
                                    }
                                    foreach($number_array as $number_ar){
                                        $last_number_array = substr($number_ar, -4);
                                        if ($last_number_array != '0000'&& (int)$number_ar>999999) {
                                            $apartment_sale_contacts->additional_phone_number = $number_ar;
                                        }
                                    }
                                    $apartment_sale->description = $description->textContent;
                                }
                                $apartment_sale->after_month = strtotime('+1 month');
                                $flat_images = [];
                                foreach ($oneimages as $key_image => $oneimage) {
                                    if ($oneimage->getAttribute('src')) {
                                        $flat_images[] = $oneimage->getAttribute('src');
                                    } else {
                                        $flat_images[] = $oneimage->getAttribute('data-src');
                                    }
                                }
                                unset($flat_images[$key_image]);
                                $apartment_sale->images = json_encode($flat_images);
                                $apartment_sale->olx_url = "https://www.olx.uz" . str_replace(' ', '', $furl->getAttribute('href'));
                                $data[] = json_encode([
                                    $apartment_sale->olx_url
                                ]);
                                foreach ($flat_price as $fprice) {
                                    $flat_price_array = explode(' ', $fprice->textContent);
                                }
                                if (str_replace(' ', '', end($flat_price_array)) == 'у.е.') {
                                    $apartment_sale->currency = 1;
                                } else {
                                    $apartment_sale->currency = 2;
                                }
                                $customer_id_string = [];
                                foreach ($seller_id as $seller) {
                                    $customer_id_string[] = $seller->textContent;
                                }
                                $customer_id_array = explode(':', $customer_id_string[0]);
                                $apartment_sale->seller_id = str_replace(' ', '', $customer_id_array[1]);
                                $IsSave = 0;
                                foreach ($flat_title as $ftitle) {
                                    $apartment_sale->title = $ftitle->textContent;
                                }
                                foreach ($flat_infos as $flat_info) {
                                    if($flat_type == null){
                                        $apartment_sale->type = json_encode(str_replace(' ', '', [$adress_city[0]]));
                                    }else{
                                        $apartment_sale->type = json_encode(str_replace(' ', '', [$flat_type]));
                                    }
                                    $flat_info_array = explode(':', $flat_info->textContent);
                                    switch (str_replace(' ', '', $flat_info_array[0])) {
                                        case 'Типжилья':
                                            $apartment_sale->housing_type = $flat_info_array[1];
                                            break;
                                        case 'Количествокомнат':
                                            $apartment_sale->number_of_rooms = (int)$flat_info_array[1];
                                            break;
                                        case 'Общаяплощадь':
                                            foreach ($flat_price as $fprice) {
                                                $f_string_price = str_replace(' ', '', $fprice->textContent);
                                                //                                    $apartment_sale->price = number_format(((int)$f_string_price / (float)$flat_info_array[1]), 2, '.', '');
                                                $apartment_sale->price = (int)$f_string_price;
                                            }
                                            $IsSave = 1;
                                            $apartment_sale->total_area = (float)$flat_info_array[1];
                                            break;
                                        case 'Жилаяплощадь':
                                            $apartment_sale->living_space = (float)$flat_info_array[1];
                                            break;
                                        case 'Площадькухни':
                                            $apartment_sale->kitchen_area = (float)$flat_info_array[1];
                                            break;
                                        case 'Этаж':
                                            $apartment_sale->floor = (int)$flat_info_array[1];
                                            break;
                                        case 'Этажностьдома':
                                            $apartment_sale->floors_of_house = (int)$flat_info_array[1];
                                            break;
                                        case 'Типстроения':
                                            $apartment_sale->building_type = $flat_info_array[1];
                                            break;
                                        case 'Планировка':
                                            $apartment_sale->housing_type = $flat_info_array[1];
                                            break;
                                        case 'Годпостройки/сдачи':
                                            $apartment_sale->year_construction = $flat_info_array[1];
                                            break;
                                        case 'Санузел':
                                            $apartment_sale->bathroom = $flat_info_array[1];
                                            break;
                                        case 'Меблирована':
                                            if (str_replace(' ', '', $flat_info_array[1]) == 'Нет') {
                                                $apartment_sale->is_furnished = 0;
                                            } else {
                                                $apartment_sale->is_furnished = 1;
                                            }
                                            break;
                                        case 'Высотапотолков':
                                            $apartment_sale->ceiling_height = (float)$flat_info_array[1];
                                            break;
                                        case 'Ремонт':
                                            $apartment_sale->repair = $flat_info_array[1];
                                            break;
                                        case 'Бизнес':
                                            $apartment_sale->business_private  = 'Бизнес';
                                            break;
                                        case 'Частноелицо':
                                            $apartment_sale->business_private  = 'Частное лицо';
                                            break;
                                        case 'Комиссионные':
                                            if (str_replace(' ', '', $flat_info_array[1]) == 'Нет') {
                                                $apartment_sale->is_commission = 0;
                                            } else {
                                                $apartment_sale->is_commission = 1;
                                            }
                                            break;
                                        case 'Связатьсяспродавцом':

                                            break;
                                        default:
                                    }
                                    if(str_replace(' ', '', $flatAddress) == "ТашкентМирзо"){
                                        $apartment_sale->address = "Ташкент Мирзо-улугбекский";
                                    }else{
                                        $apartment_sale->address = $flatAddress;
                                    }
                                    if ($IsSave == 1) {
                                        $apartment_sale->is_parser = 1;
                                        $apartment_sale->save();
                                    }
                                    if (isset($apartment_sale_contacts->first_name) || isset($apartment_sale_contacts->additional_phone_number)) {
                                        if($IsSave == 1){
                                            $apartment_sale_contacts->apartment_sale_id = $apartment_sale->id;
                                            if(isset($apartment_sale_contacts->first_name) && (int)($apartment_sale_contacts->first_name??0) > 0){
                                                $apartment_sale_contacts->first_name = null;
                                                $apartment_sale_contacts->phone_number = $apartment_sale_contacts->first_name;
                                            }
                                            $apartment_sale_contacts->save();
                                        }
                                    }
                                    switch (str_replace(' ', '', $flat_info_array[0])) {
                                        case 'Вквартиреесть':
                                            $flat_has_string = str_replace(' ', '', $flat_info_array[1]);
                                            $flat_has_array = explode(',', $flat_has_string);
                                            foreach ($flat_has_array as $key => $flat_h) {
                                                if ($flat_h == "КабельноеТВ") {
                                                    $flat_has_array[$key] = "Кабельное ТВ";
                                                } elseif ($flat_h == "Стиральнаямашина") {
                                                    $flat_has_array[$key] = "Стиральная машина";
                                                }
                                            }
                                            $apartment_has = ApartmentHas::select('id')->whereIn('name', $flat_has_array)->get();
                                            $a_has_array = [];
                                            foreach ($apartment_has as $a_has) {
                                                $a_has_array[] = $a_has->id;
                                            }
                                            if ($IsSave == 1) {
                                                $apartment_sale->apartment_has()->attach($a_has_array);
                                            }
                                            break;
                                        case 'Рядоместь':
                                            $flat_nearby_string = str_replace(' ', '', $flat_info_array[1]);
                                            $flat_nearby_array = explode(',', $flat_nearby_string);
                                            foreach ($flat_nearby_array as $n_key => $flat_n) {
                                                if ($flat_n == "ДетскаяПлощадка") {
                                                    $flat_nearby_array[$n_key] = "Детская Площадка";
                                                } elseif ($flat_n == "ДетскийСад") {
                                                    $flat_nearby_array[$n_key] = "Детский Сад";
                                                } elseif ($flat_n == "РазвитаяИнфраструктура") {
                                                    $flat_nearby_array[$n_key] = "Развитая Инфраструктура";
                                                } elseif ($flat_n == "ТЦ(РазвлекательныеЦентр)") {
                                                    $flat_nearby_array[$n_key] = "ТЦ(Развлекательные Центр)";
                                                } elseif ($flat_n == "Парк/Зеленаязона") {
                                                    $flat_nearby_array[$n_key] = "Парк/Зеленая зона";
                                                }
                                            }
                                            $apartment_nearby = ThereIsNearby::select('id')->whereIn('name', $flat_nearby_array)->get();
                                            $a_nearby_array = [];
                                            foreach ($apartment_nearby as $a_nearby) {
                                                $a_nearby_array[] = $a_nearby->id;
                                            }
                                            if ($IsSave == 1) {
                                                $apartment_sale->there_is_nearby()->attach($a_nearby_array);
                                            }
                                            break;
                                    }
                                }
                            }
                        }
                        curl_close($oneFlat);
                        sleep(4);
                    }else{
                        return redirect()->route('parser.index', app()->getLocale())->with('confirm', 'confirmed');
                    }
                }
            }
        }else{
            return redirect()->route('parser.index', app()->getLocale())->with('confirm', 'confirmed');
        }

        return redirect()->route('parser.index', app()->getLocale())->with('confirm', 'confirmed');
    }

    public function parsingUrl($url, $type_string, $type, $city){
        if(!str_contains($url, '?')){
            if($type == "taken"){
                $this->parsing($url."".$city."".$this->business_private."".$this->price_from."".$this->price_to."".$this->rooms_from."".$this->rooms_to."".$this->area_from."".$this->area_to."".$this->floor_from."".$this->floor_to."".$this->furnished."".$this->commission."".$this->housing_type, $type_string);
            }else{
                $this->parsing($url."".$type."/".$city."/?".$this->business_private."".$this->price_from."".$this->price_to."".$this->rooms_from."".$this->rooms_to."".$this->area_from."".$this->area_to."".$this->floor_from."".$this->floor_to."".$this->furnished."".$this->commission."".$this->housing_type, $type_string);
            }
        }else{
            if($type == "taken"){
                $this->parsing($url."".$city."".$this->business_private."".$this->price_from."".$this->price_to."".$this->rooms_from."".$this->rooms_to."".$this->area_from."".$this->area_to."".$this->floor_from."".$this->floor_to."".$this->furnished."".$this->commission."".$this->housing_type, $type_string);
            }else{
                $this->parsing($url."".$type."/".$city."/?".$this->business_private."".$this->price_from."".$this->price_to."".$this->rooms_from."".$this->rooms_to."".$this->area_from."".$this->area_to."".$this->floor_from."".$this->floor_to."".$this->furnished."".$this->commission."".$this->housing_type, $type_string);
            }
        }
    }

    public function parsingFilter(Request $request){
        $price_from = (int)str_replace(' ', '', $request->price_from);
        $price_to = (int)str_replace(' ', '', $request->price_to);
        $this->price_from = $price_from?"&search%5Bfilter_float_price:from%5D=".$price_from:""; //&search%5Bfilter_float_price:from%5D=40000
        $this->price_to = $price_to?"&search%5Bfilter_float_price:to%5D=".$price_to:""; //&search%5Bfilter_float_price:to%5D=50000
        $this->rooms_from = $request->rooms_from?"&search%5Bfilter_float_number_of_rooms:from%5D=".$request->rooms_from:""; //&search%5Bfilter_float_number_of_rooms:from%5D=3
        $this->rooms_to = $request->rooms_to?"&search%5Bfilter_float_number_of_rooms:to%5D=".$request->rooms_to:""; //&search%5Bfilter_float_number_of_rooms:to%5D=4
        $this->area_from = $request->area_from?"&search%5Bfilter_float_total_area:from%5D=".$request->area_from:""; //&search%5Bfilter_float_total_area:from%5D=40
        $this->area_to = $request->area_to?"&search%5Bfilter_float_total_area:to%5D=".$request->area_to:""; //&search%5Bfilter_float_total_area:to%5D=60
        $this->floor_from = $request->floor_from?"&search%5Bfilter_float_floor:from%5D=".$request->floor_from:""; //&search%5Bfilter_float_floor:from%5D=1
        $this->floor_to = $request->floor_to?"&search%5Bfilter_float_floor:to%5D=".$request->floor_to:""; //&search%5Bfilter_float_floor:to%5D=5
        $this->floors_of_house_from = $request->floors_of_house_from?"&search%5Bfilter_float_total_floors:from%5D=".$request->floors_of_house_from:""; //&search%5Bfilter_float_total_floors:from%5D=5
        $this->floors_of_house_to = $request->floors_of_house_to?"&search%5Bfilter_float_total_floors:to%5D=".$request->floors_of_house_to:""; //&search%5Bfilter_float_total_floors:to%5D=6
        switch($request->housing_type){
            case "Все объявления":
                $this->housing_type = "";
                break;
            case "Новостройки":
                $this->housing_type = "&search%5Bfilter_enum_type_of_market%5D%5B1%5D=primary"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            case "Вторичный рынок":
                $this->housing_type = "&search%5Bfilter_enum_type_of_market%5D%5B0%5D=secondary"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            default:
        }
        switch($request->furnished){
            case "Все объявления":
                $this->furnished = "";
                break;
            case "Да":
                $this->furnished = "&search%5Bfilter_enum_furnished%5D%5B0%5D=yes"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            case "Нет":
                $this->furnished = "&search%5Bfilter_enum_furnished%5D%5B0%5D=no"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            default:
        }
        switch($request->commission){
            case "Все объявления":
                $this->commission = "";
                break;
            case "Да":
                $this->commission = "&search%5Bfilter_enum_comission%5D%5B0%5D=yes"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            case "Нет":
                $this->commission = "&search%5Bfilter_enum_comission%5D%5B1%5D=no"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            default:
        }
        switch($request->business_private){
            case "Все объявления":
                $this->business_private = "";
                break;
            case "business":
                $this->business_private = "&search%5Bprivate_business%5D=business"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            case "private":
                $this->business_private = "&search%5Bprivate_business%5D=private"; //&search%5Bfilter_enum_type_of_market%5D%5B0%5D=primary
                break;
            default:
        }
        if($request->district && $request->type){
            switch ($request->type){
                case "Аренда долгосрочная":
                    if($request->region == "tashkent"){
                        $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/arenda-dolgosrochnaya/tashkent/?search%5Bdistrict_id%5D=", "Аренда долгосрочная", "arenda-dolgosrochnaya", $request->district??'');
                    }else{
                        $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", "Аренда долгосрочная", "arenda-dolgosrochnaya", $request->district??'');
                    }
                    break;
                case "Продажа":
                    if($request->region == "tashkent"){
                        $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/prodazha/tashkent/?search%5Bdistrict_id%5D=", "Продажа", "taken", $request->district??'');
                    }else{
                        $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", "Продажа", "prodazha", $request->district??'');
                    }
                    break;
                case "Обмен":
                    if($request->region == "tashkent"){
                        $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/obmen/tashkent/?search%5Bdistrict_id%5D=", "Обмен", "taken", $request->district??'');
                    }else{
                        $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", "Обмен", "obmen", $request->district??'');
                    }
                    break;
                default:
            }
        }elseif($request->region !='no'){
            if($request->region == "tashkent"){
                if($request->district){
                    $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/tashkent/?search%5Bdistrict_id%5D=", null, "", $request->district??'');
                }else{
                    $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", null, "", $request->region??'');
                }
            }elseif($request->district){
                $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", null, "", $request->district??'');
            }else{
                $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", null, "", $request->region??'');
            }
        }elseif($request->type){
            switch ($request->type){
                case "Аренда долгосрочная":
                    $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", "Аренда долгосрочная", "arenda-dolgosrochnaya", '');
                    break;
                case "Продажа":
                    $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", "Продажа", "prodazha", '');
                    break;
                case "Обмен":
                    $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", "Обмен", "obmen", '');
                    break;
                default:
            }
        }else{
            $this->parsingUrl("https://www.olx.uz/d/nedvizhimost/kvartiry/", "", "", '');
        }
        if((int)explode(' ', $this->found_f)){
            return redirect()->route('parser.index', app()->getLocale());
        }else{
            return redirect()->route('parser.index', app()->getLocale())->with('warning', __('We found 0 listings'));
        }
    }

    public function Getphone(){

    }

}
