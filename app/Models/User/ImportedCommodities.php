<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ImportedCommodities extends Model
{

    protected $table = 'imported_commodities';
    protected $keyType = 'string';
    public $timestamps = ['created_at','updated_at'];



    public function submittedAttemp(){
        return $this->belongsTo('App\Models\User\ICSubmitted','slug','slug');
    }

    public function revokedCount(){
        return $this->belongsTo('App\Models\User\ICRevoked','slug','slug');
    }
//
//    public function user(){
//        return $this->belongsTo('App\Models\User','user_created','slug');
//    }
}