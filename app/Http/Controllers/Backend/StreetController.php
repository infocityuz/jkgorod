<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\District as DistrictAlias;
use App\Models\Street;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class StreetController extends Controller
{
    public function index()
    {
        $models = Street::orderBy('id','desc')->paginate(config('params.pagination'));

        return view('backend.street.index',[
            'models' => $models,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.street.create',[

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($lang, Request $request)
    {

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $street = Street::create($data);

        return redirect()->route('street.index', app()->getLocale())->with('success', __('locale.successfully'));
    }
}
