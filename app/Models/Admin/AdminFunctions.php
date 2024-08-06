<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminFunctions extends Model{

    protected $table = 'admin_functions';
    
	public $timestamps = false;

    protected $attributes = [

        'admin_slug' => '',
        'function_slug' => '',

    ];

    public function masterFunction(){
        return $this->hasOne('App\Models\Admin\Functions', 'slug', 'function_slug');
    }

}
