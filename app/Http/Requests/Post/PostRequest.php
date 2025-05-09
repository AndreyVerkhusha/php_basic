<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'category_id' => 'string|exists:categories,id',
            'title' => 'string|max:255',
            'content' => 'string|max:255',
            'is_published' => 'string|in:true,false',
        ];
    }
}
