<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ICSubmitted extends Model
{

    protected $table = 'ic_submitted';
    public $timestamps = ['created_at', 'updated_at'];

}

