<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePost extends FormRequest
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
        $id = $this->id;
        $rules = [
            'title' => [
                'required',
                'min:3',
                'max:160',
                Rule::unique('posts')->ignore($id)
            ],
            'content' => ['nullable', 'min:5', 'max:1000'],
            'image' => ['required', 'image', 'max:3000']
        ];
        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
