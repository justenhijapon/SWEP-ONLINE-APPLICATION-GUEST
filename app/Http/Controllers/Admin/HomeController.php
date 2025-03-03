<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\User\OrderOfPayments;
use App\Models\User\OrderOfPaymentsDetailsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{	
	public function __construct(){
		$this->middleware('auth:admin');
	}

    public function index()
    {
        $draftApplicant = User\ImportedCommodities::where('received', '0')->where('revoked', '0');
        $receivedApplication = User\ImportedCommodities::where('received', '1');
        $revokedApplication = User\ImportedCommodities::where('revoked', '1');
        $totalApplication = User\ImportedCommodities::get();
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

        return view('admin.home.index')->with([
                'op' => $op,
                'opPaid' => $opPaid,
                'opUnpaid' => $opUnpaid,
                'client' => $client,
                'draftApplicant' => $draftApplicant,
                'receivedApplication' => $receivedApplication,
                'revokedApplication' => $revokedApplication,
                'totalApplication' => $totalApplication,
                ]);
    }


    public function viewFile($tableName, $slug)
    {
        $data = DB::table($tableName)->where('slug', $slug)->first();

        if (!$data) {
            abort(406, 'File not found');
        }
        if (!Storage::disk('local')->exists($data->path)) {
            abort(406, 'File not found');
        }

        return Storage::disk('local')->response($data->path);
    }

    public function viewFileCustom($tableName, $slug, $columnName = 'path')
    {
        $data = DB::table($tableName)->where('slug', '=', $slug)->first();

        if (!$data) {
            abort(406, 'File not found');
        }

        if (!Storage::disk('local')->exists($data->$columnName)) {
            abort(406, 'File not found');
        }
    }



    public function showFileCustom($tableName, $slug, $columnName = 'path') {
        // Validate table name to prevent SQL injection risk
        if (!Schema::hasTable($tableName)) {
            abort(406, 'Invalid table name.');
        }

        // Fetch record
        $data = DB::table($tableName)->where('slug', $slug)->first();

        if (!$data) {
            abort(406, 'Record not found.');
        }

        // Ensure the column exists
        if (!isset($data->$columnName)) {
            abort(406, 'Invalid column name.');
        }

        // Check if file exists
        if (!Storage::exists($data->$columnName)) {
            abort(406, 'File not found.');
        }

        // Return file response
        return Storage::response($data->$columnName);
    }


    public function showFile($tableName, $slug)
    {
        $data = DB::table($tableName)->where('slug', '=', $slug)->first();

        if(!$data || !Storage::disk('local')->exists($data->path)) {
            abort('406', 'File not found');

        }

        return Storage::disk('local')->response($data->path);
    }
}
