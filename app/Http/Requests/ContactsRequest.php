<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    public function store()
    {
        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'additional_phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:255',
        ];
    }

    public function update()
    {
        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'additional_phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:255',
        ];
    }
}
