<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;


class PreRegistrationFormRequest extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){

        $rules = [

            'username'=>'required|string|max:45|unique:pre_registration,username',
            'password'=>'sometimes|required|string|min:6|max:45|same:password_confirmation',
            'last_name'=>'required|string|max:45',
            'first_name'=>'required|string|max:45',
            'middle_name'=>'required|string|max:45',
            'gender'=>'required|string|max:45',
            'phone'=>'required|string|max:45',
            'email'=>'required|string|email|max:45|unique:pre_registration,email',
            'birthday'=>'required|date|max:45',
            'street' => 'required|string|max:45',
            'barangay' => 'required|string|max:45',
            'city'=>'required|string|max:45',
            'region'=>'required|string|max:45',
            'province'=>'required|string|max:45',
        ];

        return $rules;

    }





}
