<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'nota_number' => 'required|string|max:255',
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'reported_issue' => 'required|string',
            'serial_number' => 'required|string|max:255',
            'technician_note' => 'nullable|string',
            'status' => 'required|string|in:Perangkat Baru Masuk,Sedang Diperbaiki,Menunggu Spare Part,Selesai,Siap Diambil,Sudah Diambil',
            'price' => 'nullable|numeric|min:0',
            'complete_in' => 'nullable|date',
        ];
    }
}
