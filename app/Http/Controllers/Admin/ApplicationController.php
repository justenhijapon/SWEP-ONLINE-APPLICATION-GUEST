<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ApplicationFormRequest;
use App\Http\Requests\Admin\TransactionTypeRequest;
use App\Models\User\ImportedCommodities;
use App\Models\User\TransactionType;
use App\Swep\Repositories\Admin\ApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class ApplicationController extends Controller
{

    protected $application;
    public function __construct(ApplicationRepository $application)
    {
        $this->application = $application;
    }

    public function index()
    {
        if (request()->ajax()) {
            $query = $this->application->fetchTable(request()); // Fetch only submission = 1

            return DataTables::of($query)
                ->editColumn('slug', function($data) {
                    return '<h4><code>' . $data->slug . '</code></h4><hr style="margin-bottom: 2px;margin-top: 2px;">
                        <small class="text-muted">Date: ' . date("M. d, Y|h:i A", strtotime($data->created_at)) . '</small>';
                })

                ->editColumn('application_type', function($data) {
                    return '<p style="font-size: small" class="no-margin">' . $data->application_type . '</p>';
                })

                ->editColumn('name', function($data) {
                    return view('admin.application.dt.NameDetails')->with(['data' => $data]);
                })

                ->editColumn('prod_description', function($data) {
                    return view('admin.application.dt.ProductDescription')->with(['data' => $data]);
                })

                ->editColumn('purpose_importation', function($data) {
                    return view('admin.application.dt.PurposeImportation')->with(['data' => $data]);
                })

                ->editColumn('status', function($data) {
                    return view('admin.application.dt.status')->with(['data' => $data]);
                })

                ->addColumn('action', function($data) {
                    return view('admin.application.dt.action')->with(['data' => $data]);
                })

                ->rawColumns(['slug', 'application_type', 'action'])
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }

        return view('admin.application.index');
    }

    public function edit($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.application.edit', compact('data'));
    }

    public function update(Request $request, $slug) {
        $app_data = ImportedCommodities::where('slug', $slug)->firstOrFail();
        $app_data->received = $request->received;
        $app_data->received_date = now();
        $app_data->revoked = 0;
        $app_data->save();
        return response()->json(['slug' => $app_data->slug]);
    }

    public function revokedUpdate($slug, Request $request)
    {
        $data = ImportedCommodities::where('slug', $slug)->firstOrFail();

        // Always set revoked to 1 and received to 0
        $data->revoked = 1;
        $data->received = 0;
        $data->revoked_date = now(); // Always update revoked_date

        $data->update();

        return response()->json([
            'slug' => $data->slug,
            'revoked' => $data->revoked,
            'revoked_date' => $data->revoked_date,
            'received' => $data->received
        ]);
    }




    public function show($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.application.show', compact('data'));
    }

//    public function destroy($slug) {
//        $transaction_type_db = TransactionType::where('slug', '=', $slug)->first();
//        $transaction_type_db->destroy();
//    }

//    public function store(Request $request) {
//        $transaction_type = new TransactionType();
//        $transaction_type->slug = $request->slug;
//        $transaction_type->name = $request->name;
//        $transaction_type->transaction_types_group_slug = $request->group;
//        $transaction_type->unit = $request->unit;
//        $transaction_type->fee_per_unit = $request->feePerUnit;
//        $transaction_type->regular_fee = $request->regularFee;
//        $transaction_type->expedite_fee = $request->expediteFee;
//        $transaction_type->save();
//    }
}
