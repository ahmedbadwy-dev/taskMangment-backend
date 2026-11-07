<?php

namespace App\Http\Requests\posts;

use Illuminate\Foundation\Http\FormRequest;
use Override;
use Illuminate\Support\Facades\trait\FailedResponse;
class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=>"required",
            "post_content"=>"required",
          
        ];
    }

  
     public function messages()
     {
        return[
           "title.required"=>"يجب ادخال اسم البوست",
            "post_content.required" => "يجب ادخال  محتوي البوست ",
     
        ];
        }


}
