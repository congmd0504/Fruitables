<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' =>'required',
            'phone'         => 'required',
            'address'       => 'required|min:3',
            'note'          => 'required',
            'total'         =>'required',
            'payment_method' => 'required',
            'product_id'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'idDiscount'=> 'required'
        ];
    }
}
