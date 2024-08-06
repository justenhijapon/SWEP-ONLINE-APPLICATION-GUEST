<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\OrderOfPayments;
use App\Models\User\OrderOfPaymentsDetailsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{	
	public function __construct(){
		$this->middleware('auth:admin');
	}

    public function index()
    {
        $op = OrderOfPayments::get();
        $opPaid = OrderOfPayments::where('status', 'PAID')->get();
        $opUnpaid = OrderOfPayments::where('status', '<>', 'PAID')->get();

        $client_db = User::get();
        $client = [];
        if(!empty($client_db)){
            foreach($client_db as $client_db){
                $client[$client_db->slug] = [
                    'slug' => $client_db->slug,
                    'last_name' => $client_db->last_name,
                    'first_name' => $client_db->first_name,
                    'middle_name' => $client_db->middle_name,
                    'business_name' => $client_db->business_name,
                ];
            }
        }

        return view('admin.home.index')->with(['op' => $op, 'opPaid' => $opPaid, 'opUnpaid' => $opUnpaid, 'client' => $client]);
    }
}
