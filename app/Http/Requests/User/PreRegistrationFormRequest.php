<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;


class PreRegistrationFormRequest extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){

        $rules = [

            'password'=>'required|string|min:6|max:45|same:password_confirmation',
            'password_confirmation'=>'required|string|min:6|max:45|same:password',
            'last_name'=>'required|string|max:45',
            'first_name'=>'required|string|max:45',
            'middle_name'=>'required|string|max:45',
            'gender'=>'required|string|max:45',
            'phone'=>'required|regex:/^[\d\s\+\-()]+$/',
            'email'=>'required|string|email|max:45|unique:pre_registration,email',
            'birthday'=>'required|date|max:45',
            'street' => 'required|string|max:120',
            'barangay' => 'required|string|max:45',
            'city'=>'required|string|max:45',
            'business_name'=>'required|string|max:120',
            'business_tin'=>'required|regex:/^[\d\s\+\-()]+$/',
            'business_phone'=>'required|regex:/^[\d\s\+\-()]+$/',
            'position'=>'required|string|max:45',
            'business_street'=>'required|string|max:120',
            'business_barangay'=>'required|string|max:45',
            'business_city'=>'required|string|max:45',
            'consent'=>'required',
        ];


        return $rules;

    }





}
