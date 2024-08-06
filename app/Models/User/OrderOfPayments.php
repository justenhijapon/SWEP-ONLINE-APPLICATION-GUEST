<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderOfPayments extends Model
{
    /*public static function boot()
    {
        OrderOfPayments::updating(function ($user) {
            $user->user_updated = Auth::guard("admin")->user()->slug;
        });
    }*/

    protected $table = 'order_of_payments';
    //protected $primaryKey = 'slug';
    protected $keyType = 'string';
    public $timestamps = ['created_at','updated_at'];



    public function supportingDocuments(){
        return $this->hasMany('App\Models\User\SupportingDocuments','transaction_id','slug');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_created','slug');
    }
}