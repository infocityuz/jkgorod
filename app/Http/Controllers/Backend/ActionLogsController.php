<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActionLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionLogsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = ActionLogs::orderBy('id','desc')->paginate(config('params.pagination'));
        return view('backend.action-logs.index',[
            'models' => $models
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $model = ActionLogs::findOrfail($id);

        return view('backend.action-logs.show',[
            'model' => $model
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        ActionLogs::findOrFail($id)->delete();
        return back()->with('success', __('locale.deleted'));
    }

    public function destroyMultiple($lang, Request $request)
    {
        $data_ids = $request->ids;
        if ($data_ids) {
            DB::table("action_logs")->whereIn('id',explode(",",$data_ids))->delete();
            return response()->json(['success'=>"успешно удален"]);
        }
    }

    public function destroyAll($lang, Request $request)
    {
        ActionLogs::truncate();
        return back()->with('success', __('locale.deleted'));
    }
}
