<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjectTableRequest extends BaseFormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'title' => 'required|string|max:255',
            'description'=> 'nullable|string|max:500',
            'address'=>'required|string|max:255',
            'floor'=>'nullable|integer|max:1000',
            'ceiling_height'=>'nullable|integer|max:1000000',
            'price'=>'required|numeric|between:0,99999999999.99',
            'currency'=>'required|integer|max:2',
            'category_id' => 'required|integer|max:1000', #relation done
            'object_parent_element' => 'nullable|string|max:255', #relation
            'build_type'=>'array',
            'build_type.*'=>'integer',
            'service_fee' => 'required|numeric|between:0,1000000.99',
            'site' => 'nullable|string|max:255',
            'region_id' => 'required|integer|max:1000000', #relation done
            'town_id' => 'integer|max:1000000', #relation done
            'area_id' => 'integer|max:1000000' , #relation done
            'street' => 'required|string|max:1000000' , #relation done
            'house_number' => 'nullable|string|max:1000000',
            'village_name' => 'nullable|string|max:500',
            'village_lastname' => 'nullable|string|max:500',
            'build_year' => 'nullable|string|max:500',
            'build_area' => 'nullable|numeric|between:0,1000000.99',
            'yard_count' => 'nullable|integer|max:1000000',
            'house_count' => 'nullable|integer|max:1000000',
            'house_area_min' => 'nullable|numeric|between:0,1000000.99',
            'house_area_max' => 'nullable|numeric|between:0,1000000.99',
            'yard_area_min' => 'nullable|numeric|between:0,1000000.99',
            'yard_area_max' => 'nullable|numeric|between:0,1000000.99',
            'external_infrastructure' => 'nullable|string|max:500',
            'internal_infrastructure' => 'nullable|string|max:500',
            'object_security' => 'nullable|string|max:255', #relation  done
            'repair' => 'nullable|string|max:255', #relation done
            'building_name' => 'nullable|string|max:500' ,
            'building_section' => 'nullable|string|max:500',
            'building_state' => 'nullable|string|max:500',
            'ready_quarter' => 'nullable|integer|max:1000000',
            'floor_count' => 'nullable|integer|max:1000000',
            'material' => 'nullable|string|max:255', #relation done
            'building_class' => 'nullable|string|max:255', #relation done
            'legal_address' => 'nullable|string|max:500' ,
            'access' => 'nullable|string|max:255', #relation done
            'parking' => 'nullable|string|max:1000000',
            'parking_price' => 'nullable|integer|max:1000000',
            'internet' => 'nullable|string|max:1000000',
            'internet_type' => 'nullable|string|max:500' ,
            'work_plan' => 'nullable|string|max:1000000',
            'lift' => 'nullable|string|max:1000000',
            'lift_person_count' => 'nullable|numeric|between:0,1000000.99',
            'work_type' => 'nullable|string|max:255',
            'cost_of_legal_address' => 'nullable|string|max:500' ,

            'ads' => 'nullable|string|max:10000' ,
            'body' => 'nullable|string|max:10000' ,

            'start_date' => 'nullable|date',
            'finish_date' => 'nullable|date',
            'contract_admin_id' => 'nullable|integer|max:100000',
            'contract_number' => 'nullable|string|max:255',
            'contract_fee' => 'nullable|string|max:255',

            'user_type' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:500',
            'first_name' => 'nullable|string|max:500',
            'surename' => 'nullable|string|max:500',
            'more_info' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:255',
            'additional_phone' => 'nullable|string|max:255',
            'phone_code' => 'nullable|string|max:255',
            'admin_id' => 'nullable|integer|max:100000',
            'email' => 'nullable|string|max:255',

            'images' => 'nullable',
            'images.*' => 'mimes:jpeg,jpg,png|max:10240',

            'files' => 'nullable',
            'files.*' => 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg|max:10240'

        ];
    }


    public function update()
    {
        return [
            'title' => 'required|string|max:255',
            'description'=> 'nullable|string|max:500',

            'address'=>'required|string|max:255',
            'floor'=>'nullable|integer|max:1000',
            'ceiling_height'=>'nullable|numeric|between:0,99999999999.99',
            'price'=>'required|numeric|between:0,99999999999.99',
            'currency'=>'required|integer|max:2',
            'category_id' => 'required|integer|max:1000', #relation done
            'object_parent_element' => 'nullable|string|max:255', #relation
            'build_type'=>'array',
            'build_type.*'=>'integer',
            'service_fee' => 'required|numeric|between:0,1000000.99',
            'site' => 'nullable|string|max:255',
            'region_id' => 'required|integer|max:1000000', #relation done
            'town_id' => 'integer|max:1000000', #relation done
            'area_id' => 'integer|max:1000000' , #relation done
            'street' => 'required|string|max:1000000' , #relation done
            'house_number' => 'nullable|string|max:1000000',
            'village_name' => 'nullable|string|max:500',
            'village_lastname' => 'nullable|string|max:500',
            'build_year' => 'nullable|string|max:500',
            'build_area' => 'nullable|numeric|between:0,1000000.99',
            'yard_count' => 'nullable|integer|max:1000000',
            'house_count' => 'nullable|integer|max:1000000',
            'house_area_min' => 'nullable|numeric|between:0,1000000.99',
            'house_area_max' => 'nullable|numeric|between:0,1000000.99',
            'yard_area_min' => 'nullable|numeric|between:0,1000000.99',
            'yard_area_max' => 'nullable|numeric|between:0,1000000.99',
            'external_infrastructure' => 'nullable|string|max:500',
            'internal_infrastructure' => 'nullable|string|max:500',
            'object_security' => 'nullable|string|max:255', #relation  done
            'repair' => 'nullable|string|max:255', #relation done
            'building_name' => 'nullable|string|max:500' ,
            'building_section' => 'nullable|string|max:500',
            'building_state' => 'nullable|string|max:500',
            'ready_quarter' => 'nullable|integer|max:1000000',
            'floor_count' => 'nullable|integer|max:1000000',
            'material' => 'nullable|string|max:255', #relation done
            'building_class' => 'nullable|string|max:255', #relation done
            'legal_address' => 'nullable|string|max:500' ,
            'access' => 'nullable|string|max:255', #relation done
            'parking' => 'nullable|string|max:255',
            'parking_price' => 'nullable|integer|max:1000000',
            'internet' => 'nullable|string|max:255',
            'internet_type' => 'nullable|string|max:500' ,
            'work_plan' => 'nullable|string|max:255',
            'lift' => 'nullable|string|max:255',
            'lift_person_count' => 'nullable|numeric|between:0,1000000.99',
            'work_type' => 'nullable|string|max:255',
            'cost_of_legal_address' => 'nullable|numeric|between:0,1000000.99',

            'ads' => 'nullable|string|max:10000',
            'body' => 'nullable|string|max:10000',

            'start_date' => 'nullable|date',
            'finish_date' => 'nullable|date',
            'contract_admin_id' => 'nullable|integer|max:100000',
            'contract_number' => 'nullable|string|max:255',
            'contract_fee' => 'nullable|string|max:255',

            'user_type' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:500',
            'first_name' => 'nullable|string|max:500',
            'surename' => 'nullable|string|max:500',
            'more_info' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:255',
            'additional_phone' => 'nullable|string|max:255',
//            'phone_code' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'admin_id' => 'nullable|integer|max:100000',

            'images' => 'nullable',
            'images.*' => 'mimes:jpeg,jpg,png|max:10240',

            'files' => 'nullable',
            'files.*' => 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg|max:10240'
        ];
    }

}