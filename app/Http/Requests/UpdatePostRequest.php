<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('update', $this->route('post'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|min:3|unique:posts,title,$this->route('post')->id|max:255",
            "category" => "required|integer|exists:categories,id",
            "description" => "required|min:10"
        ];
    }

    public function messages()
    {
       return[
        "title.required" => "ခေါင်းစဥ်ထည့်အုန်း ငါးကောင်း "
       ];
    }
}
