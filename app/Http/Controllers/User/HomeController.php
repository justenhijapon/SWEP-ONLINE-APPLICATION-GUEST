<?php

namespace App\Http\Controllers\User;

use App\Models\User\ICRevoked;
use App\Models\User\ICSubmitted;
use App\Models\User\ImportedCommodities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

//        return view('user.home.index');
//        $data = ImportedCommodities::all();
    public function index()
    {
        $userSlug = Auth::guard('web')->user()->slug;

        $data = ImportedCommodities::where('user_created', $userSlug)->first();

        $submittedAttempts = ICSubmitted::where('user_created', $userSlug)->get();
        $revokedAttempts = ICRevoked::where('user_created', $userSlug)->get();

        $timeline = [];

        // Merge submitted and revoked attempts into one timeline array
        foreach ($submittedAttempts as $submitted) {
            $timeline[] = [
                'type' => $timeline ? 'Resubmitted' : 'Submitted',
                'data' => $submitted
            ];
        }

        foreach ($revokedAttempts as $revoked) {
            $timeline[] = [
                'type' => 'Revoked',
                'data' => $revoked
            ];
        }

        // Sort timeline by submission_date in DESCENDING order (latest first)
        usort($timeline, function ($a, $b) {
            return strtotime($b['data']->submission_date) - strtotime($a['data']->submission_date);
        });

        return view('dashboard.ImportedCommodities.edit', compact('timeline', 'data'));
    }




    public function showFileCustom($tableName, $slug, $columnName = 'path')
    {
        if (!Schema::hasTable($tableName)) {
            abort(406, 'Invalid table name.');
        }

        $data = DB::table($tableName)->where('slug', $slug)->first();

        if (!$data || !isset($data->$columnName)) {
            abort(406, 'File not found.');
        }

        $filePath = $data->$columnName;

        if (!Storage::exists($filePath)) {
            abort(406, 'File does not exist.');
        }

        // Determine the file type
        $mimeType = Storage::mimeType($filePath);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Handle inline display for images and PDFs
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
            return Response::make(Storage::get($filePath), 200, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
            ]);
        }

        // For other files, force download
        return Storage::download($filePath);
    }

    public function getFilePaths($slug)
    {
        // Fetch data from the database
        $data = DB::table('imported_commodities')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // List of file columns
        $fileColumns = [
            'application_form_path',
            'affidavit_path',
            'bill_landing_path',
            'commercial_invoice_path',
            'packing_list_path',
            'cert_origin_path',
            'cert_analysis_path',
            'notarized_gmo_non_gmo_path',
            'important_declaration_path'
        ];

        $filePaths = [];
        foreach ($fileColumns as $column) {
            if (!empty($data->$column) && Storage::exists($data->$column)) {
                $filePaths[$column] = route('show_file_custom', [
                    'tableName' => 'imported_commodities',
                    'slug' => $slug,
                    'columnName' => $column
                ]);
            }
        }

        return response()->json($filePaths);
    }



//    public function showFileCustom($tableName, $slug, $columnName = 'path') {
//        // Validate table name
//        if (!Schema::hasTable($tableName)) {
//            Log::error("Invalid table name: $tableName");
//            abort(404, 'Invalid table name.');
//        }
//
//        // Fetch record
//        $data = DB::table($tableName)->where('slug', $slug)->first();
//
//        if (!$data) {
//            Log::error("Record not found for slug: $slug in table: $tableName");
//            abort(404, 'Record not found.');
//        }
//
//        // Ensure the column exists
//        if (!isset($data->$columnName)) {
//            Log::error("Column $columnName not found in table: $tableName");
//            abort(404, 'Invalid column name.');
//        }
//
//        // Check if file exists
//        if (!Storage::exists($data->$columnName)) {
//            Log::error("File not found at path: " . $data->$columnName);
//            abort(404, 'File not found.');
//        }
//
//        Log::info("Serving file: " . $data->$columnName);
//
//        return Storage::response($data->$columnName);
//    }

//    public function showFileCustom($tableName, $slug, $columnName = 'path') {
//        // Validate table name to prevent SQL injection risk
//        if (!Schema::hasTable($tableName)) {
//            abort(404, 'Invalid table name.');
//        }
//
//        // Fetch record
//        $data = DB::table($tableName)->where('slug', $slug)->first();
//
//        if (!$data) {
//            abort(404, 'Record not found.');
//        }
//
//        // Ensure the column exists
//        if (!isset($data->$columnName)) {
//            abort(404, 'Invalid column name.');
//        }
//
//        // Check if file exists
//        if (!Storage::exists($data->$columnName)) {
//            abort(404, 'File not found.');
//        }
//
//        // Return file response
//        return Storage::response($data->$columnName);
//    }


}