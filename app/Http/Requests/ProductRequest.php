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
            // 'images' => ['mimes:jpeg,png,jpg,gif'],
            'main_image' => ['required'],
            'image' => ['required'],
            'product_name' => ['required', 'string', 'max:50'],
            'product_price' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'tags' => ['required'],
            'about_this_paint' => ['required', 'string'],
            'details_1' => ['required', 'string'],
            'details_2' => ['required', 'string'],
        ];
    }
}
