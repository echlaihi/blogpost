<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
                'title'   => 'required|string|min:5|max:255',
                'body'    => 'required|string|min:50|max:50000',
                // 'img'     => 'nullable|mimes:jpeg,png,jpg|dimensions:max_with=2000,max_height=1000',
        ];
    }
}
