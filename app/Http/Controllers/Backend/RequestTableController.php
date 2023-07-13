<?php

namespace App\Http\Controllers\Backend;

use App\components\ImageResize;
use App\components\StaticFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApartmentSaleRequest;
use App\Http\Requests\RequestTableRequest;
use App\Models\ApartmentHas;
use App\Models\ApartmentHasApartmentSale;
use App\Models\Area;
use App\Models\Category;
use App\Models\ObjectTable;
use App\Models\Region;
use App\Models\RequestTable;
use App\Models\BuildingType;
use App\Models\ApartmentSaleContacts;
use App\Models\ApartmentSaleImages;
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

class RequestTableController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = RequestTable::select('id','user_id','title','address','price_from', 'price_to', 'currency')->orderBy('id','desc')->paginate(config('params.pagination'));
        return view('backend.request.index', [
            'models' => $models
        ]);
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
        // Log::channel('action_logs')->info("пользователь хочет создать новую квартиру");

        return view('backend.request.create',[
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
    public function store($lang, RequestTableRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        ($request->is_exchange === 'on') ? $data['is_exchange'] = 1 : $data['is_exchange'] = 0;
        ($request->is_furnished == 'on') ? $data['is_furnished'] = 1 : $data['is_furnished'] = 0;
        ($request->is_commission == 'on') ? $data['is_commission'] = 1 : $data['is_commission'] = 0;
        $data['user_id'] = Auth::user()->id;
        $data['type'] = json_encode($request->flat_types);
        $request_table = RequestTable::create($data);
        if(isset($data['apartment_has'])){
            foreach ($data['apartment_has'] as $apartment_h){
                $apartment_has = new ApartmentHasApartmentSale();
                $apartment_has->apartment_sale_id = $request_table->id;
                $apartment_has->apartment_has_id = $apartment_h;
                $apartment_has->is_request = 1;
                $apartment_has->save();
            }
        }
        if(isset($data['there_is_nearby'])){
            foreach ($data['there_is_nearby'] as $there_h){
                $there_is_nearby = new ThereIsNearbyApartmentSale();
                $there_is_nearby->apartment_sale_id = $request_table->id;
                $there_is_nearby->there_is_nearby_id = $there_h;
                $there_is_nearby->is_request = 1;
                $there_is_nearby->save();
            }
        }
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
            $request_table->contacts()->save($apartment_sale_contacts);
        }

        Log::channel('action_logs')->info("пользователь создал новую квартиру : " . $request_table->title."",['info-data'=>$request_table]);

        return redirect()->route('request.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApartmentSale  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $model = RequestTable::findOrFail($id);
        Log::channel('action_logs')->info("пользователь показал ".$model->title." квартиру",['info-data'=>$model]);
        return view('backend.request.show',[
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
        $model = RequestTable::findOrFail($id);
        $apartments = ApartmentHas::all();
        $there_is_nearbies = ThereIsNearby::all();
        Log::channel('action_logs')->info("пользователь собирается обновить ".$model->title." распродажу квартиру",['info-data'=>$model]);
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
        return view('backend.request.edit',[
            'model' => $model,
            'region' => $region,
            'category' => $category,
            'town' => $town,
            'area' => $area,
            'apartments' => $apartments,
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
    public function update($lang,  RequestTableRequest $request, $id)
    {
        $data = $request->validated();
        $model = RequestTable::findOrFail($id);
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

        $model->price_from = $data['price_from'];
        $model->price_to = $data['price_to'];

        $model->currency = $data['currency'];
        $model->repair = $data['repair'];
        $model->layout = $data['layout'];
        $model->bathroom = $data['bathroom'];
        $model->building_type = $data['building_type'];
        $model->housing_type = $data['housing_type'];
        $model->distance_to_metro = $data['distance_to_metro'];
        $model->metro = $data['metro'];
        $model->save();
        if(isset($data['apartment_has'])){
            $model->apartment_has()->detach();
            foreach ($data['apartment_has'] as $apartment_h){
                $apartment_has = new ApartmentHasApartmentSale();
                $apartment_has->apartment_sale_id = $model->id;
                $apartment_has->apartment_has_id = $apartment_h;
                $apartment_has->is_request = 1;
                $apartment_has->save();
            }
        }
        if(isset($data['there_is_nearby'])){
            $model->there_is_nearby()->detach();
            foreach ($data['there_is_nearby'] as $there_h){
                $there_is_nearby = new ThereIsNearbyApartmentSale();
                $there_is_nearby->apartment_sale_id = $model->id;
                $there_is_nearby->there_is_nearby_id = $there_h;
                $there_is_nearby->is_request = 1;
                $there_is_nearby->save();
            }
        }

        $contacts = $model->contacts;
        if (!empty($contacts)){
            $contacts->first_name = $data['first_name'];
            $contacts->last_name = $data['last_name'];
            $contacts->surname = $data['surname'];
            $contacts->phone_number = $data['phone_number'];
            $contacts->additional_phone_number = $data['additional_phone_number'];
            $contacts->email = $data['email'];
            $contacts->is_request = 1;
            $model->contacts()->save($contacts);
        }else{
            $contacts = new ApartmentSaleContacts();
            $contacts->first_name = $data['first_name'];
            $contacts->last_name = $data['last_name'];
            $contacts->surname = $data['surname'];
            $contacts->phone_number = $data['phone_number'];
            $contacts->additional_phone_number = $data['additional_phone_number'];
            $contacts->email = $data['email'];
            $contacts->is_request = 1;
            $model->contacts()->save($contacts);
        }

        Log::channel('action_logs')->info("пользователь обновил ".$model->title." квартиру",['info-data'=>$model]);
        return redirect()->route('request.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApartmentSale  $realEstate
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $apartment_sale = RequestTable::findOrFail($id);
        $apartment_sale->apartment_has()->detach();
        $apartment_sale->there_is_nearby()->detach();
        $apartment_sale->contacts()->delete();
        $apartment_sale->delete();
        Log::channel('action_logs')->info("пользователь удалил ".$apartment_sale->title." квартиру",['info-data'=>$apartment_sale->description]);
        return back()->with('success', __('locale.deleted'));
    }
    public function alldestroy()
    {
        $apartment_sale = RequestTable::select('id')->get();
        $id_array = [];
        foreach($apartment_sale as $apartment){
            $id_array[] = $apartment->id;
        }
        unset($id_array[array_search(10, $id_array)]);
        unset($id_array[array_search(11, $id_array)]);
        foreach ($id_array as $id_a){
            $apartment_d = RequestTable::find($id_a);
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

    public function fileDeleteAll($lang, Request $request)
    {
        // dd('fileDeleteAll');
        File::deleteDirectory(public_path('/uploads/tmp_files/' . Auth::user()->id.'/apartment-sale'));
        return response()->json('successfully');
    }

}
