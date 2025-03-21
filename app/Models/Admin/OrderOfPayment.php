<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OrderOfPayment extends Model
{

    protected $table = 'order_of_payment';
    public $timestamps = ['created_at', 'updated_at'];
    public $incrementing = false;

    protected $attributes = [

        'reference_no' => '',
        'fullname' => null,
        'company' => null,
        'position' => null,
        'tin' => null,
        'amount' => '',
        'amount_in_word' => '',
        'lkg_bags' => '',
        'metric_tons' => '',
        'boc_entry_no' => '',
        'boc_entry_note' => '',
        'certified_correct' => '',

    ];

    protected $fillable = [
        'fullname',
        'position',
        'company',
        'tin',

    ];

}

