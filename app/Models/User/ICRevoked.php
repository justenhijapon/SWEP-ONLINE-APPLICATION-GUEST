<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ICRevoked extends Model
{

    protected $table = 'ic_revoked';
    public $timestamps = ['created_at', 'updated_at'];

}

