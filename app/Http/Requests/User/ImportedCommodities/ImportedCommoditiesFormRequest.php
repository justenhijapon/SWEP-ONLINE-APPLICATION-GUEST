<?php

namespace App\Http\Requests\User\ImportedCommodities;

use Illuminate\Foundation\Http\FormRequest;

class ImportedCommoditiesFormRequest extends FormRequest
{


    public function authorize()
    {

        return true;

    }

    public function rules()
    {
        $rules = [];

        if ($this->method() == 'POST') {
            $rules = [
                'date'=>'required',
                'name'=>'required',
                'designation'=>'required',
                'company'=>'required',
                'tin'=>'required',
                'contact_no'=>'required',
                'email'=>'required',
                'address'=>'required',
                'bill_landing_no'=>'required',
                'country_origin'=>'required',
                'commodity'=>'required',
                'h_s_code'=>'required',
                'volume'=>'required',
                'quantity_mt'=>'required',
                'packaging'=>'required',
                'vessel_name'=>'required',
                'port_entry'=>'required',
//                'prod_description'=>'required',
//                'port_discharge'=>'required',
//                'purpose_importation'=>'required',
            ];








        }

        if ($this->method() == 'PATCH') {
            $rules = [
                'date'=>'required',
                'name'=>'required',
                'designation'=>'required',
                'company'=>'required',
                'tin'=>'required',
                'contact_no'=>'required',
                'email'=>'required',
                'address'=>'required',
                'bill_landing_no'=>'required',
                'country_origin'=>'required',
                'commodity'=>'required',
                'h_s_code'=>'required',
                'volume'=>'required',
                'quantity_mt'=>'required',
                'packaging'=>'required',
                'vessel_name'=>'required',
                'port_entry'=>'required',
//                'prod_description'=>'required',
//                'port_discharge'=>'required',
//                'purpose_importation'=>'required',
            ];
        }

        return $rules;


    }
}

