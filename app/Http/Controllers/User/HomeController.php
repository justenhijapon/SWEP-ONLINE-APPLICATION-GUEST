<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home.index');
    }


    public function viewFile($tableName, $slug)
    {
        $data = DB::table($tableName)->where('slug', $slug)->first();

        if (!$data) {
            abort(502, 'File not found');
        }
        if (!Storage::disk('local')->exists($data->path)) {
            abort(502, 'File not found');
        }

        return Storage::disk('local')->response($data->path);
    }

    public function viewFileCustom($tableName, $slug, $columnName = 'path')
    {
        $data = DB::table($tableName)->where('slug', '=', $slug)->first();

        if (!$data) {
            abort(502, 'File not found');
        }

        if (!Storage::disk('local')->exists($data->$columnName)) {
            abort(502, 'File not found');
        }


    }
}