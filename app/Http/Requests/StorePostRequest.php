<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create', Post::class );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|min:3|max:255",
            "category" => "required|integer|exists:categories,id",
            "description" => "required|min:10",
            "photos" => "nullable",
            "photos.*" => "file|max:3000|mimes:jpg,png",
            "tags" => "required",
            "tags.*" => "integer|exists:tags,id"
        ];
    }
}
