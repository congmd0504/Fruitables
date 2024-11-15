<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class PostUserAdminRequest extends FormRequest
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
            'username' => 'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=> 'required|min:5',
            'confirmPassword' =>'required|same:password',
            'fullname'=>'nullable',
            'address'=>'nullable',
            'phone'=>'nullable',
            'image' => 'nullable|image',
        ];
    }
}
