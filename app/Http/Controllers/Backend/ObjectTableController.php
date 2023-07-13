<?php

namespace App\Http\Controllers\Backend;

use App\components\ImageResize;
use App\components\StaticFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\ObjectTableRequest;

use App\Models\ApartmentSaleContacts;
use App\Models\ApartmentSaleImages;
use App\Models\Area;
use App\Models\BuildingType;
use App\Models\Category;
use App\Models\District;
use App\Models\ObjectContacts;
use App\Models\ObjectContract;
use App\Models\ObjectDocument;
use App\Models\ObjectImages;
use App\Models\ObjectRegion;
use App\Models\ObjectTable;
use App\Models\Region;
use App\Models\Street;
use App\Models\Town;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ObjectTableController extends Controller
{
    public function index()
    {
        $models = ObjectTable::with('main_image')->select('id', 'user_id', 'title', 'address', 'price')->orderBy('id', 'desc')->paginate(config('params.pagination'));
        Log::channel('action_logs')->info("пользователь просмотрел Коммерческие помещения");

        return view('backend.object.index', [
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
        $parent = ObjectTable::all();

        // $regions = ObjectRegion::all();
        // $streets = Street::all();
        // $districts = District::all();

        $buildingTypes = BuildingType::all();

        $users = User::all();
        $category = Category::all();

        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files'))) {
            $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files'));
        }

        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images'))) {
            $images_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images'));
        }

        // Log::channel('action_logs')->info("пользователь хочет создать новую Коммерческие помещения");

        $region = Region::all();

        return view('backend.object.create', [
            'parent' => $parent,
            'region' => $region,
            // 'town' => $town,
            // 'area' => $area,
            // 'regions' => $regions,
            // 'streets' => $streets,
            // 'districts' => $districts,
            'buildingTypes' => $buildingTypes,
            'users' => $users,
            'category' => $category,
            'files_saved' => $files_saved ?? '',
            'images_saved' => $images_saved ?? '',
        ]);
    }

    public function findTown($lang, $id)
    {
        $town = Town::select('id', 'name')->where('region_id', (int)$id)->get();
        $partResponce = '<option value="0">------------</option>';
        if (!empty($town)) {
            foreach ($town as $val) {
                $partResponce .= '<option value="' . $val->id . '">' . $val->name . '</option>';
            }
        }
        $area = false;
        if ($id == Region::TASHKENT)
            $area = true;

        return ['area' => $area, 'data' => $partResponce];
    }

    public function findArea($lang, $id)
    {
        $area = Area::select('id', 'name')->where('town_id', (int)$id)->get();
        $partResponce = '<option value="0">------------</option>';
        if (!empty($area)) {
            foreach ($area as $val) {
                $partResponce .= '<option value="' . $val->id . '">' . $val->name . '</option>';
            }
        }
        return $partResponce;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($lang, ObjectTableRequest $request)
    {
        $data = $request->validated();
        ($request->site === 'on') ? $data['site'] = 1 : $data['site'] = 0;

        $data['user_id'] = Auth::user()->id;

        $object = ObjectTable::create($data);

        // $object->building_type()->attach($data['build_type']);

        $object_contract = new ObjectContract();
        $object_contract->start_date = $data['start_date'];
        $object_contract->finish_date = $data['finish_date'];
        $object_contract->contract_number = $data['contract_number'];
        $object_contract->contract_fee = $data['contract_fee'];
        $object_contract->contract_admin_id = $data['user_id'];
        $object->contract()->save($object_contract);

        $object_contacts = new ObjectContacts();
        // $object_contacts->user_info = $data['user_info'];
        $object_contacts->last_name = $data['last_name'];
        $object_contacts->first_name = $data['first_name'];
        $object_contacts->surename = $data['surename'];
        $object_contacts->more_info = $data['more_info'];
        $object_contacts->user_type = $data['user_type'];
        $object_contacts->phone_number = $data['phone_code'] . $data['phone_number'];
        $object_contacts->email = $data['email'];
        $object_contacts->admin_id = $data['admin_id'];
        $object->contacts()->save($object_contacts);

        //=================== Image yuklanyapti ===================
        if (!file_exists(public_path('uploads/object/images/' . $object->id))) {
            $path = public_path('uploads/object/images/' . $object->id);
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if (!file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images'))) {
            $path_tmp = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/images');
            File::makeDirectory($path_tmp, $mode = 0777, true, true);
        }
        $images_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images'));
        foreach ($images_saved as $files_savedItem) {
            $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/images/' . $files_savedItem->getFilename());
            $filenamehash = md5($files_savedItem->getFilename() . time()) . '.' . $files_savedItem->getExtension();
            $filesize =  File::size($sourcePath);

            $pathInfo = pathinfo($sourcePath);
            if ($pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpeg' || $pathInfo['extension'] == 'svg') {
                $imageR = new ImageResize($sourcePath);
                $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/object/images/' . $object->id . '/l_' . $filenamehash));
                $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/object/images/' . $object->id . '/m_' . $filenamehash));
                $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/object/images/' . $object->id . '/s_' . $filenamehash));
            } else {
                $storageDestinationPath = public_path('uploads/apartment-sale/' . $object->id . '/' . $filenamehash);
                File::move($sourcePath, $storageDestinationPath);
            }

            ObjectImages::create([
                'object_id' => $object->id,
                'name' => $files_savedItem->getFilename(),
                'guid' => $filenamehash,
                'ext' => $files_savedItem->getExtension(),
                'size' => $filesize ?? '',
            ]);

            File::delete($sourcePath);
        }
        //=================== Image yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================

        //=================== file yuklanyapti ===================
        if (!file_exists(public_path('uploads/object/files/' . $object->id))) {
            $path = public_path('uploads/object/images/' . $object->id);
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if (!file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files'))) {
            $path_tmp = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/files');
            File::makeDirectory($path_tmp, $mode = 0777, true, true);
        }
        $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files'));
        $j = 0;
        foreach ($files_saved as $files_savedItem) {
            $j++;
            $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/files/' . $files_savedItem->getFilename());
            $filenamehash = md5($files_savedItem->getFilename() . time()) . '.' . $files_savedItem->getExtension();
            $filesize =  File::size($sourcePath);

            ObjectDocument::create([
                'object_id' => $object->id,
                'name' => $files_savedItem->getFilename(),
                'guid' => $filenamehash,
                'ext' => $files_savedItem->getExtension(),
                'size' => $filesize ?? '',
            ]);

            File::delete($sourcePath);
        }
        //=================== file yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================
        Log::channel('action_logs')->info("пользователь создал новую Коммерческие помещения : " . $object->title . "", ['info-data' => $object]);

        return redirect()->route('object.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $model = ObjectTable::findOrFail($id);
        Log::channel('action_logs')->info("пользователь показал " . $model->title . " Коммерческие помещения", ['info-data' => $model]);

        return view('backend.object.show', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $model = ObjectTable::findOrFail($id);

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

        // $regions = ObjectRegion::all();
        // $streets = Street::all();
        // $districts = District::all();

        $buildingTypes = BuildingType::all();

        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files'))) {
            $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files'));
        }

        if (file_exists(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images'))) {
            $images_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images'));
        }

        $users = User::all();
        Log::channel('action_logs')->info("пользователь собирается обновить " . $model->title . " распродажу Коммерческие помещения", ['info-data' => $model]);

        return view('backend.object.edit', [
            'model' => $model,
            'parent' => $parent,
            'region' => $region,
            'category' => $category,
            'town' => $town,
            'area' => $area,
            // 'streets' => $streets,
            // 'districts' => $districts,
            'buildingTypes' => $buildingTypes,
            'users' => $users,
            'files_saved' => $files_saved ?? '',
            'images_saved' => $images_saved ?? '',
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
    public function update($lang, ObjectTableRequest $request, $id)
    {
        $data = $request->validated();
        $model = ObjectTable::findOrFail($id);
        ($request->site === 'on') ? $data['site'] = 1 : $data['site'] = 0;

        $model['user_id'] = Auth::user()->id;

        $model->title = $data['title'];
        $model->description = $data['description'];
        $model->address = $data['address'];
        $model->category_id = $data['category_id'];
        // $model->object_parent_element = $data['object_parent_element'];

        $model->currency = $data['currency'];
        $model->price = $data['price'];

        $model->service_fee = $data['service_fee'];
        $model->site = $data['site'];
        $model->region_id = $data['region_id'];
        $model->town_id = $data['town_id'];
        $model->area_id = $data['area_id'];

        // $model->district_id = $data['district_id'];
        // $model->street_id = $data['street_id'];

        $model->house_number = $data['house_number'];

        $model->floor = $data['floor'];
        $model->ceiling_height = $data['ceiling_height'];
        $model->village_name = $data['village_name'];
        $model->village_lastname = $data['village_lastname'];
        $model->build_year = $data['build_year'];
        $model->build_area = $data['build_area'];
        $model->yard_count = $data['yard_count'];
        $model->house_count = $data['house_count'];
        $model->house_area_min = $data['house_area_min'];
        $model->house_area_max = $data['house_area_max'];
        $model->yard_area_min = $data['yard_area_min'];
        $model->yard_area_max = $data['yard_area_max'];
        $model->external_infrastructure = $data['external_infrastructure'];
        $model->internal_infrastructure = $data['internal_infrastructure'];
        $model->object_security = $data['object_security'];
        $model->repair = $data['repair'];
        $model->building_name = $data['building_name'];
        $model->building_section = $data['building_section'];
        $model->building_state = $data['building_state'];
        $model->ready_quarter = $data['ready_quarter'];
        $model->floor_count = $data['floor_count'];
        $model->material = $data['material'];
        $model->building_class = $data['building_class'];
        $model->legal_address = $data['legal_address'];
        $model->access = $data['access'];
        $model->parking = $data['parking'];
        $model->parking_price = $data['parking_price'];
        $model->internet = $data['internet'];
        $model->internet_type = $data['internet_type'];
        $model->work_plan = $data['work_plan'];
        $model->lift = $data['lift'];
        $model->lift_person_count = $data['lift_person_count'];
        $model->work_type = $data['work_type'];
        $model->cost_of_legal_address = $data['cost_of_legal_address'];
        $model->ads = $data['ads'];
        // $model->body = $data['body'];

        $model->save();

        // $model->building_type()->sync($data['build_type']);


        $contacts = $model->contacts;
        if (!empty($contacts)) {
            // $contacts->user_info = $data['user_info'];
            $contacts->last_name = $data['last_name'];
            $contacts->first_name = $data['first_name'];
            $contacts->surename = $data['surename'];
            $contacts->more_info = $data['more_info'];
            $contacts->user_type = $data['user_type'];
            $contacts->phone_number = $data['phone_number'];
            $contacts->additional_phone = $data['additional_phone'];
            $contacts->admin_id = $data['admin_id'];
            $contacts->email = $data['email'];
            $model->contacts()->save($contacts);
        } else {
            $contacts = new ObjectContacts();
            $contacts->user_info = $data['user_info'];
            $contacts->more_info = $data['more_info'];
            $contacts->user_type = $data['user_type'];
            $contacts->phone_number = $data['phone_number'];
            $contacts->admin_id = $data['admin_id'];
            $contacts->email = $data['email'];
            $model->contacts()->save($contacts);
        }

        $contracts = $model->contract;
        if (!empty($contracts)) {
            $contracts->start_date = $data['start_date'];
            $contracts->finish_date = $data['finish_date'];
            $contracts->contract_number = $data['contract_number'];
            $contracts->contract_fee = $data['contract_fee'];
            $model->contract()->save($contracts);
        } else {
            $contracts = new ObjectContract();
            $contracts->start_date = $data['start_date'];
            $contracts->finish_date = $data['finish_date'];
            $contracts->contract_number = $data['contract_number'];
            $contracts->contract_fee = $data['contract_fee'];
            $model->contract()->save($contracts);
        }

        //=================== Image yuklanyapti ===================
        if (!file_exists(public_path('uploads/object/images/' . $model->id))) {
            $path = public_path('uploads/object/images/' . $model->id);
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if (!file_exists(public_path('uploads/tmp_files/' . Auth::user()->id . '/object/images'))) {
            $path_tmp = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/images');
            File::makeDirectory($path_tmp, $mode = 0777, true, true);
        }

        $images_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images'));
        foreach ($images_saved as $files_savedItem) {
            $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/images/' . $files_savedItem->getFilename());
            $filenamehash = md5($files_savedItem->getFilename() . time()) . '.' . $files_savedItem->getExtension();
            $filesize =  File::size($sourcePath);

            $pathInfo = pathinfo($sourcePath);
            if ($pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpeg' || $pathInfo['extension'] == 'svg') {
                $imageR = new ImageResize($sourcePath);
                $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.width'))->save(public_path('uploads/object/images/' . $model->id . '/l_' . $filenamehash));
                $imageR->resizeToWidth(config('params.medium_image.width'))->save(public_path('uploads/object/images/' . $model->id . '/m_' . $filenamehash));
                $imageR->crop(config('params.small_image.width'), config('params.small_image.height'))->save(public_path('uploads/object/images/' . $model->id . '/s_' . $filenamehash));
            } else {
                $storageDestinationPath = public_path('uploads/apartment-sale/' . $model->id . '/' . $filenamehash);
                File::move($sourcePath, $storageDestinationPath);
            }

            ObjectImages::create([
                'object_id' => $model->id,
                'name' => $files_savedItem->getFilename(),
                'guid' => $filenamehash,
                'ext' => $files_savedItem->getExtension(),
                'size' => $filesize ?? '',
            ]);

            File::delete($sourcePath);
        }
        //=================== Image yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================

        //=================== file yuklanyapti ===================
        if (!file_exists(public_path('uploads/object/files/' . $model->id))) {
            $path = public_path('uploads/object/files/' . $model->id);
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        if (!file_exists(public_path('uploads/tmp_files/' . Auth::user()->id . '/object/files'))) {
            $path_tmp = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/files');
            File::makeDirectory($path_tmp, $mode = 0777, true, true);
        }

        $files_saved = File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files'));
        $j = 0;
        foreach ($files_saved as $files_savedItem) {
            $j++;
            $sourcePath = public_path('uploads/tmp_files/' . Auth::user()->id . '/object/files/' . $files_savedItem->getFilename());
            $filenamehash = md5($files_savedItem->getFilename() . time()) . '.' . $files_savedItem->getExtension();
            $filesize =  File::size($sourcePath);

            $storageDestinationPath = public_path('uploads/object/files/' . $model->id . '/' . $filenamehash);
            File::move($sourcePath, $storageDestinationPath);

            ObjectDocument::create([
                'object_id' => $model->id,
                'name' => $files_savedItem->getFilename(),
                'guid' => $filenamehash,
                'ext' => $files_savedItem->getExtension(),
                'size' => $filesize ?? '',
            ]);

            File::delete($sourcePath);
        }
        //=================== file yuklash yakunlandi === mana shu controllerdagi fileUpload methodga qara ===================

        Log::channel('action_logs')->info("пользователь обновил " . $model->title . " Коммерческие помещения", ['info-data' => $model]);

        return redirect()->route('object.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $objectTable = ObjectTable::findOrFail($id);
        $objectTable->delete();
        Log::channel('action_logs')->info("пользователь удалил " . $objectTable->title . " Коммерческие помещения", ['info-data' => $objectTable]);

        return redirect()->route('object.index', app()->getLocale())->with('success', __('locale.successfully'));
        // return back()->with('success', __('locale.deleted'));
    }

    public function destroy_img_item($lang, Request $request, $id)
    {
        if ($request->ajax()) {
            $model = ObjectImages::findOrFail($id);
            File::delete(public_path('uploads/object/' . $model->object_id . '/' . $model->guid));
            File::delete(public_path('uploads/object/' . $model->object_id . '/l_' . $model->guid));
            File::delete(public_path('uploads/object/' . $model->object_id . '/m_' . $model->guid));
            File::delete(public_path('uploads/object/' . $model->object_id . '/s_' . $model->guid));
            $model->delete();
            return response()->json([
                'success' => __('locale.deleted')
            ]);
        }
    }

    public function destroy_file_item($lang, Request $request, $id)
    {
        if ($request->ajax()) {
            $model = ObjectDocument::findOrFail($id);
            File::delete(public_path('uploads/object/' . $model->object_id . '/' . $model->guid));
            File::delete(public_path('uploads/object/' . $model->object_id . '/l_' . $model->guid));
            File::delete(public_path('uploads/object/' . $model->object_id . '/m_' . $model->guid));
            File::delete(public_path('uploads/object/' . $model->object_id . '/s_' . $model->guid));
            $model->delete();
            return response()->json([
                'success' => __('locale.deleted')
            ]);
        }
    }

    //==================== kartik fileinput resource/apartment-sale/create scripts dagi fileinputga qara ==================================
    public function fileUpload($lang, Request $request)
    {
        if ($request->ajax()) {
            $preview = $config = $errors = [];
            $input = 'files';
            if (empty($_FILES[$input])) {
                return [];
            }
            $total = count($_FILES[$input]['name']); // multiple files
            if (!file_exists(public_path('uploads/tmp_files/' . Auth::user()->id . '/' . 'object/files'))) {
                $path = public_path('uploads/tmp_files/' . Auth::user()->id . '/' . 'object/files');
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $path = public_path('uploads/tmp_files/' . Auth::user()->id . '/' . 'object' . '/files/'); // your upload path
            for ($i = 0; $i < $total; $i++) {
                $filecount = count(File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/' . 'object/files')));

                $tmpFilePath = $_FILES[$input]['tmp_name'][$i]; // the temp file path
                $fileName = $_FILES[$input]['name'][$i];
                $fileSize = $_FILES[$input]['size'][$i];

                if ($tmpFilePath != "") {
                    $newFilePath = $path . $fileName;
                    $newFileReName = $path . '/' . $filecount++ . '_' . $fileName;
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        rename($newFilePath, $newFileReName);

                        $pathInfo = pathinfo($path . $newFileReName);
                        $newFileReNamePreView = '/uploads/tmp_files/' . Auth::user()->id . '/' . 'object' . '/files/' . $pathInfo['basename'];
                        $fileId = $pathInfo['basename'] . $i; // some unique key to identify the file
                        $preview[] = $newFileReNamePreView;
                        $config[] = [
                            'key' => $fileId,
                            'caption' => $pathInfo['basename'],
                            'size' => $fileSize,
                            'downloadUrl' => $pathInfo['basename'], // the url to download the file
                            'url' => '/real-estate/' . 'object' . '/image-delete/' . $pathInfo['basename'], // server api to delete the file based on key
                        ];
                    } else {
                        $errors[] = $fileName;
                    }
                } else {
                    $errors[] = $fileName;
                }
            }
            $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
            if (!empty($errors)) {
                $img = count($errors) === 1 ? 'file "' . $errors[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
                $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
            }
            return $out;
        }
    }

    public function fileDelete($lang, Request $request, $key)
    {
        $filePath = public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/files/' . $key);
        return File::delete($filePath);
    }

    //==================== yakunladni kartik fileinput resource/object/create scripts dagi fileinputga qara ==================================

    //==================== kartik fileinput resource/object/create scripts dagi fileinputga qara ==================================
    public function imageUpload($lang, Request $request)
    {
        if ($request->ajax()) {
            $preview = $config = $errors = [];
            $input = 'images';
            if (empty($_FILES[$input])) {
                return [];
            }
            $total = count($_FILES[$input]['name']); // multiple files
            if (!file_exists(public_path('uploads/tmp_files/' . Auth::user()->id . '/' . 'object/images'))) {
                $path = public_path('uploads/tmp_files/' . Auth::user()->id . '/' . 'object/images');
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $path = public_path('uploads/tmp_files/' . Auth::user()->id . '/' . 'object' . '/images/'); // your upload path
            for ($i = 0; $i < $total; $i++) {
                $filecount = count(File::allFiles(public_path('/uploads/tmp_files/' . Auth::user()->id . '/' . 'object/images')));

                $tmpFilePath = $_FILES[$input]['tmp_name'][$i]; // the temp file path
                $fileName = $_FILES[$input]['name'][$i];
                $fileSize = $_FILES[$input]['size'][$i];

                if ($tmpFilePath != "") {
                    $newFilePath = $path . $fileName;
                    $newFileReName = $path . '/' . $filecount++ . '_' . $fileName;
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        rename($newFilePath, $newFileReName);

                        $pathInfo = pathinfo($path . $newFileReName);
                        $newFileReNamePreView = '/uploads/tmp_files/' . Auth::user()->id . '/' . 'object' . '/images/' . $pathInfo['basename'];
                        $fileId = $pathInfo['basename'] . $i; // some unique key to identify the file
                        $preview[] = $newFileReNamePreView;
                        $config[] = [
                            'key' => $fileId,
                            'caption' => $pathInfo['basename'],
                            'size' => $fileSize,
                            'downloadUrl' => $pathInfo['basename'], // the url to download the file
                            'url' => '/real-estate/' . 'object' . '/image-delete/' . $pathInfo['basename'], // server api to delete the file based on key
                        ];
                    } else {
                        $errors[] = $fileName;
                    }
                } else {
                    $errors[] = $fileName;
                }
            }
            $out = ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
            if (!empty($errors)) {
                $img = count($errors) === 1 ? 'file "' . $errors[0]  . '" ' : 'files: "' . implode('", "', $errors) . '" ';
                $out['error'] = 'Oh snap! We could not upload the ' . $img . 'now. Please try again later.';
            }
            return $out;
        }
    }

    public function imageDelete($lang, Request $request, $key)
    {
        $filePath = public_path('/uploads/tmp_files/' . Auth::user()->id . '/object/images/' . $key);
        return File::delete($filePath);
    }

    //==================== yakunladni kartik fileinput resource/object/create scripts dagi fileinputga qara ==================================

}