<?php

namespace App\traits;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
trait FailedResponse{

  function   failedValidation(Validator $validator){


  throw new HttpResponseException(


   response()->json([
 
"Success"=>false,
"message"=>" data is invalid",
"error"=>$validator->errors()



],422)


  ) ;





  }



}