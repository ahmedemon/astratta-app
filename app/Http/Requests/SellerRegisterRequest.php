<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'unique:sellers'],
            'email' => ['required', 'unique:sellers'],
            'phone' => ['required', 'unique:sellers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'paintings' => ['nullable', 'mimes:png,jpg,jpeg,gif', 'max:2048'],
            'privacy_policy' => ['required', 'boolean'],
            'contact_agreement' => ['required', 'boolean'],
        ];
    }
}
