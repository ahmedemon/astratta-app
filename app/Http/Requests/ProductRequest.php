<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'image' => ['mimes:png,jpg'],
            'product_name' => ['required', 'string', 'max:255'],
            'product_price' => ['required', 'integer'],
            'category' => ['required', 'integer'],
            'tags' => ['required'],
            'about_paint' => ['required', 'string'],
            'details_col_1' => ['required', 'string'],
            'details_col_2' => ['required', 'string'],
        ];
    }
}
