<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTableRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function store()
    {
        return [
            'type' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description'=>'nullable|string|max:500',
            'address'=>'nullable|string|max:255',
            'region_id'=>'nullable|string|max:255',
            'town_id'=>'nullable|string|max:255',
            'area_id'=>'nullable|string|max:255',
            'landmark'=>'nullable|string|max:255',
            'organization'=>'nullable|string|max:255',
            'total_area'=>'nullable|numeric|between:0,100000000.99',
            'living_space'=>'nullable|numeric|between:0,100000000.99',
            'kitchen_area'=>'nullable|numeric|between:0,100000000.99',
            'floor'=>'nullable|integer|max:1000000',
            'floors_of_house'=>'nullable|integer|max:1000000',
            'number_of_rooms'=>'nullable|integer|max:1000000',
            'ceiling_height'=>'nullable|numeric|between:0,100000000.99',
            'year_construction'=>'nullable|date',
            'price_from'=>'nullable|numeric|between:0,100000000.99',
            'price_to'=>'nullable|numeric|between:0,100000000.99',
            'currency'=>'nullable|integer|max:10',
            'is_exchange'=>'nullable',
            'is_furnished'=>'nullable',

            'is_commission'=>'nullable',
            'is_commission_percent'=>'nullable|string|max:255',
            'is_commission_number'=>'nullable|string|max:255',

            'apartment_has'=>'nullable|array',
            'apartment_has.*'=>'integer',
            'there_is_nearby'=>'nullable|array',
            'there_is_nearby.*'=>'integer',

            'repair'=>'nullable|string|max:255',
            'layout'=>'nullable|string|max:255',
            'bathroom'=>'nullable|string|max:255',
            'building_type'=>'nullable|string|max:255',
            'housing_type'=>'nullable|string|max:255',

            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'phone_code' => 'nullable|string|max:20',
            'phone_code2' => 'nullable|string|max:20',
            'additional_phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:255',
            'distance_to_metro' => 'nullable|string|max:255',
            'metro' => 'nullable|string|max:255',
            'is_request' => 'nullable|number|max:11',

            'files' => 'nullable',
            'files.*' => 'mimes:jpeg,jpg,png|max:10240'

        ];
    }

    public function update()
    {
        return [
            'type' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description'=>'nullable|string|max:500',
            'address'=>'required|string|max:255',
            'region_id'=>'nullable|string|max:255',
            'town_id'=>'nullable|string|max:255',
            'area_id'=>'nullable|string|max:255',
            'landmark'=>'nullable|string|max:255',
            'organization'=>'nullable|string|max:255',
            'total_area'=>'required|numeric|between:0,100000000.99',
            'living_space'=>'nullable|numeric|between:0,100000000.99',
            'kitchen_area'=>'nullable|numeric|between:0,100000000.99',
            'floor'=>'nullable|integer|max:1000000',
            'floors_of_house'=>'nullable|integer|max:1000000',
            'number_of_rooms'=>'nullable|integer|max:1000000',
            'ceiling_height'=>'nullable|numeric|between:0,100000000.99',
            'year_construction'=>'nullable|date',
            'price_from'=>'nullable|numeric|between:0,100000000.99',
            'price_to'=>'nullable|numeric|between:0,100000000.99',
            'currency'=>'nullable|integer|max:10',
            'is_exchange'=>'nullable',
            'is_furnished'=>'nullable',

            'is_commission'=>'nullable',
            'is_commission_percent'=>'nullable|string|max:255',
            'is_commission_number'=>'nullable|string|max:255',

            'apartment_has'=>'nullable|array',
            'apartment_has.*'=>'integer',
            'there_is_nearby'=>'nullable|array',
            'there_is_nearby.*'=>'integer',

            'repair'=>'nullable|string|max:255',
            'layout'=>'nullable|string|max:255',
            'bathroom'=>'nullable|string|max:255',
            'building_type'=>'nullable|string|max:255',
            'housing_type'=>'nullable|string|max:255',

            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'phone_code' => 'nullable|string|max:20',
            'phone_code2' => 'nullable|string|max:20',
            'additional_phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:255',
            'distance_to_metro' => 'nullable|string|max:255',
            'metro' => 'nullable|string|max:255',
            'is_request' => 'nullable|number|max:11',

            'files' => 'nullable',
            'files.*' => 'mimes:jpeg,jpg,png|max:10240'
        ];
    }
}
