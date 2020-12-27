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
            'title'   => 'required|string|max:255',
            'body'    => 'required|string|max:1000',
            'img'     => 'nullable|mimes:jpeg,png|dimensions:max_with=2000,max_height=1000,min_width=700,min_height=500',
            'user_id' => 'required|integer|exists:App\Models\User,id',
        ];
    }
}
