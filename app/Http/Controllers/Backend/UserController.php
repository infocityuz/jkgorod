<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\components\ImageResize;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\ForTheBuilder\Entities\Task;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = User::where('status',1)->orderBy('id','desc')->paginate(config('params.pagination'));
        Log::channel('action_logs')->info("пользователь просмотрел Пользователь");

        return view('backend.user.index',[
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
        $roles = Role::all();

        Log::channel('action_logs')->info("пользователь хочет создать новую Пользователь");

        return view('backend.user.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($lang, UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
//        $image = $data['avatar'];
//        $imageName = md5(time().$image).'.'.$image->getClientOriginalExtension();
//        $data['avatar'] = $imageName;
//        $model = User::create($data);
//
//        //bu yerda orginal rasm yuklanyapti ochilgan papkaga
//        $image->move(public_path('uploads/user/'.$model->id),$imageName);
//
//        //bu yerda orginal rasm  app/components/imageresize.php fayliga kesiladigan rasm manzili ko'rsatilyapti
//        $imageR = new ImageResize( public_path('uploads/user/'.$model->id . '/' . $imageName));
//
//        //bu yerda orginal rasm  app/components/imageresize.php fayli orqali kesilyapti
//        $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.width'))->save(public_path('uploads/user/'.$model->id . '/s_' . $imageName));
//        //bu yerda orginal rasm  o'chirilyapti.chunki endi bizga kerakmas orginali biz o'zimizga kerkligicha kesib oldik
//        File::delete(public_path('uploads/user/'.$model->id.'/'.$imageName));

        $image = $data['avatar'] ?? '';
        if (!empty($image)) {
            $imageName = md5(time().$image).'.'.$image->getClientOriginalExtension();
            $data['avatar'] = $imageName;
        }

        $model = User::create($data);
        if (!empty($image)) {
            //bu yerda orginal rasm yuklanyapti ochilgan papkaga
            $image->move(public_path('uploads/user/'.$model->id),$imageName);

            //bu yerda orginal rasm  app/components/imageresize.php fayliga kesiladigan rasm manzili ko'rsatilyapti
            $imageR = new ImageResize( public_path('uploads/user/'.$model->id . '/' . $imageName));

            //bu yerda orginal rasm  app/components/imageresize.php fayli orqali kesilyapti
            $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.width'))->save(public_path('uploads/user/'.$model->id . '/s_' . $imageName));
            //bu yerda orginal rasm  o'chirilyapti.chunki endi bizga kerakmas orginali biz o'zimizga kerkligicha kesib oldik
            File::delete(public_path('uploads/user/'.$model->id.'/'.$imageName));

        }

        Log::channel('action_logs')->info("пользователь создал новую Пользователь : " . $model->first_name."",['info-data'=>$model]);

        return redirect()->route('user.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $user = Auth::user();
        $model = User::findOrfail($id);
        Log::channel('action_logs')->info("пользователь показал ".$model->first_name." Пользователь",['info-data'=>$model]);
        return view('backend.user.show',[
            'model' => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $model = User::findOrfail($id);
        $roles = Role::all();

        Log::channel('action_logs')->info("пользователь собирается обновить ".$model->first_name." распродажу Пользователь",['info-data'=>$model]);

        return view('backend.user.edit',[
            'model' => $model,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($lang, UserRequest $request, $id)
    {
        $data = $request->validated();
        $model = User::findOrFail($id);

        $model->first_name = $data['first_name'];
        $model->last_name = $data['last_name'];
        $model->middle_name = $data['middle_name'];
        $model->email = $data['email'];
        $model->role_id = $data['role_id'];
        if ($model->status == 10) $model->status = 10;
        else $model->status = $data['status'];
        $model->save();

        if(!empty($request->input('current_password'))) {
            if(!Hash::check($request->input('current_password'), $model->password)){
                return back()->with('current_password', 'Current password does not match!');
            }else{
                $model->fill(['password' => Hash::make($request->input('password'))])->save();
            }
        }

        if (!empty($data['avatar']))
        {
            $image = $data['avatar'];
            $image_old = $model->avatar;
            $imageName = md5(time().$image).'.'.$image->extension();

            //bu yerda orginal rasm yuklanyapti ochilgan papkaga
            $image->move(public_path('uploads/user/'.$model->id),$imageName);

            //bu yerda orginal rasm  app/components/imageresize.php fayliga kesiladigan rasm manzili ko'rsatilyapti
            $imageR = new ImageResize( public_path('uploads/user/'.$model->id . '/' . $imageName));

            //bu yerda orginal rasm  app/components/imageresize.php fayli orqali kesilyapti
            $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.width'))->save(public_path('uploads/user/'.$model->id . '/s_' . $imageName));
            //bu yerda orginal rasm  o'chirilyapti.chunki endi bizga kerakmas orginali biz o'zimizga kerkligicha kesib oldik
            File::delete(public_path('uploads/user/'.$model->id.'/'.$imageName));
            File::delete(public_path('uploads/user/'.$model->id.'/s_'.$image_old));

            $model->avatar = $imageName;
            $model->save();
        }

        Log::channel('action_logs')->info("пользователь обновил ".$model->first_name." Пользователь",['info-data'=>$model]);

        return redirect()->route('user.index', app()->getLocale())->with('success', __('locale.successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $user = User::findOrFail($id);
        if($user->id != Auth::user()->id) $user->delete();
        Log::channel('action_logs')->info("пользователь удалил ".$user->first_name." Пользователь",['info-data'=>$user]);
        return back()->with('success', __('locale.deleted'));
    }

//    public function delete()
//    {
//        if (Gate::allows('isAdmin')) {
//            dd('Admin allowed');
//        } else {
//            dd('You are not Admin');
//        }
//    }

}
