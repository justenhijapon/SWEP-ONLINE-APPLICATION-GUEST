<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateAccountUsernameRequest extends FormRequest{


   
    public function authorize(){

        return true;
    
    }

    



    public function rules(){
    	
        return [

            'email' => 'required|max:45|string|unique:users,email',

        ];

    }





}
