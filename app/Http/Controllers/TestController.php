<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Test::orderBy('id','desc')->paginate(config('params.pagination'));
        Log::channel('action_logs')->info("пользователь просмотрел test");

        return view('backend.test.index',[
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
        Log::channel('action_logs')->info("пользователь хочет создать новую test");

        return view('backend.test.create',[

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(testRequest $request)
    {
        $data = $request->validated();

        $model = Test::create($data);

        Log::channel('action_logs')->info("пользователь создал новую test : ",['info-data'=>$model]);

        return redirect()->route('test.index')->with('success', __('locale.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Test::findOrFail($id);
        Log::channel('action_logs')->info("пользователь показал test",['info-data'=>$model]);
        return view('backend.test.show',[
            'model' => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = Test::findOrFail($id);

        Log::channel('action_logs')->info("пользователь собирается обновить test",['info-data'=>$model]);
        return view('backend.test.edit',[
            'model' => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(testRequest $request, $id)
    {
        $data = $request->validated();
        $model = Test::findOrFail($id);

        //$model->test = $data['test'];

        $model->save();

        Log::channel('action_logs')->info("пользователь обновил test",['info-data'=>$model]);
        return redirect()->route('test.index')->with('success', __('locale.successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Test::findOrFail($id);
        $model->delete();
        Log::channel('action_logs')->info("пользователь удалил test",['info-data'=>$model]);
        return back()->with('success', __('locale.deleted'));
    }
}
