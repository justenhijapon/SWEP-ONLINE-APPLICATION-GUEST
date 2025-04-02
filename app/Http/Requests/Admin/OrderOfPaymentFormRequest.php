<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderOfPaymentFormRequest extends FormRequest{

    public function authorize(){

        return true;
    }

    public function rules(){

        $rules = [


            'reference_no'=>'required',
            'fullname'=>'required',
            'lkg_bags'=>'required',
            'metric_tons'=>'required',
            'boc_entry_no'=>'required',
            'boc_entry_note'=>'required',
            'certified_correct'=>'required',
            'approved_by'=>'required',
            'company'=>'required',

        ];


        return $rules;

    }
}