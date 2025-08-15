<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
    public function rules()
    {
        return [
            'member_id' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|numeric',
            'prices' => 'required',
            'total_payment' => 'required',
            'location' => 'required | string',
            'type' => 'required',
            'request' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return back()->with('error','Terdapat kesalahan pada input, mohon untuk melakukan input ulang');
    }
}
