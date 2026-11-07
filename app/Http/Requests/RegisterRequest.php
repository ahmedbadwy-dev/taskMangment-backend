<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\traits\FailedResponse;
use Illuminate\Contracts\Validation\Validator;
use Override;

class RegisterRequest extends FormRequest
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
           "name"=>"required",
           "email"=>"required |unique:users,email|email",
           "password"=>"required|min:8|max:50"
        ];
    }


 function messages()
 {
    return[
"name.required"=>"يجب ادخال اسم المستخدم",
"email.required"=>"يجب ادخال الايميل",
"email.unique"=>"يجب استخدام ايميل اخر",
"password.unique"=>"يجب ادخال كلمه سر",
"password.min"=>"يجب ان لا تقل كلمه السر عن 8 حروف",
"password.max"=>"يجب ان لاتزيد كلمه السر عن 50 حرف ورقم"
    ];
 }



}
