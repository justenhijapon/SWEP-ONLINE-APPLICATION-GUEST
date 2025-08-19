<?php

namespace App\Models\Admin;

use App\Models\User\ImportedCommodities;
use Illuminate\Database\Eloquent\Model;

class OrderOfPayment extends Model
{

    protected $table = 'order_of_payment';
    public $timestamps = ['created_at', 'updated_at'];
    public $incrementing = false;

    protected $attributes = [

        'slug' => null,
        'ic_slug' => null,
        'reference_no' => null,
        'fullname' => null,
        'company' => null,
        'position' => null,
        'tin' => null,
        'contact' => null,
        'amount' => null,
        'amount_in_word' => null,
        'lkg_bags' => null,
        'metric_tons' => null,
        'boc_entry_no' => null,
        'boc_entry_note' => null,
        'certified_correct' => null,

    ];

    protected $fillable = [
        'fullname',
        'position',
        'company',
        'tin',

    ];

    public function importedCommodity(){
        return $this->belongsTo('App\Models\User\ImportedCommodities','slug','slug');
    }

}

