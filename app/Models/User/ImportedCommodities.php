<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ImportedCommodities extends Model
{
//    public static function boot()
//    {
//        ImportedCommodities::updating(function ($user) {
//            $user->user_updated = Auth::guard("web")->user()->slug;
//        });
//
//
//    }

    protected $table = 'imported_commodities';
    //protected $primaryKey = 'slug';
    protected $keyType = 'string';
    public $timestamps = ['created_at','updated_at'];



//    public function supportingDocuments(){
//        return $this->hasMany('App\Models\User\SupportingDocuments','transaction_id','slug');
//    }
//
//    public function user(){
//        return $this->belongsTo('App\Models\User','user_created','slug');
//    }
}