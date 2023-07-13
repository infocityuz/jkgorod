<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ApartmentHas;
use App\Models\ApartmentHasApartmentSale;
use App\Models\ApartmentSale;
use App\Models\ObjectTable;
use App\Models\RequestTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackendController extends Controller
{
    public function index()
    {
//        Artisan::call('optimize');
//        dd('good');
        $ManuallyFlatsCount = ApartmentSale::where('is_parser', null)->count();
        $ParsedFlatsCount = ApartmentSale::where('is_parser', 1)->count();
        $ObjectCount = ObjectTable::all()->count();
        $requestCount = RequestTable::all()->count();


        return view('backend.index',[
            'ManuallyFlatsCount' => $ManuallyFlatsCount,
            'ParsedFlatsCount' => $ParsedFlatsCount,
            'ObjectCount' => $ObjectCount,
            'requestCount' => $requestCount,
        ]);
    }
}
