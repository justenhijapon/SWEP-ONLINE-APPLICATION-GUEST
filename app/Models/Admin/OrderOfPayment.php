<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OrderOfPayment extends Model
{

    protected $table = 'order_of_payment';
    public $timestamps = ['created_at', 'updated_at'];

    protected $attributes = [

        'reference_no' => '',
        'fullname' => '',
        'company' => '',
        'amount' => '',
        'amount_in_word' => '',
        'lkg_bags' => '',
        'metric_tons' => '',
        'boc_entry_no' => '',
        'boc_entry_note' => '',
        'certified_correct' => '',

    ];

}

