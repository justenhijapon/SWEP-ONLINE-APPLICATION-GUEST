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
            ];
        }

        if ($this->method() == 'PATCH') {
            $rules = [
            ];
        }

        return $rules;


    }
}

