<?php

namespace Modules\ForTheBuilder\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\ForTheBuilder\Entities\Leads;
use Modules\ForTheBuilder\Http\Requests\LeadsApiRequest;

class LeadsApiController  extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(LeadsApiRequest $request)
    {

        $data['status'] = 'Новый';
        // $data['requestid'] = Uii;
        $leads = Leads::create($data);
        return response()->json(['success'=>'successfilly created']);

    }


}
