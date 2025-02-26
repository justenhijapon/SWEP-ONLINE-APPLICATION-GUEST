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
                '',
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
                'quantity_mt'=>'required',
                'bill_landing_no'=>'required',
                'country_origin'=>'required',
                'prod_description'=>'required',
                'port_discharge'=>'required',
                'purpose_importation'=>'required',
            ];
        }

        return $rules;


    }
}

