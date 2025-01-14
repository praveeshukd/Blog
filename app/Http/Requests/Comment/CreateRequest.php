<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

           'content'    => 'required',
           'user_id'    => 'required',
           'blog_id'    => 'required'
    
        ];
    }
}
