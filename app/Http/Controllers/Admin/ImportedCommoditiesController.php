<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ApplicationFormRequest;
use App\Http\Requests\Admin\TransactionTypeRequest;
use App\Models\User\ICRevoked;
use App\Models\User\ICSubmitted;
use App\Models\User\ImportedCommodities;
use App\Models\User\TransactionType;
use App\Swep\Repositories\Admin\ImportedCommoditiesRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class ImportedCommoditiesController extends Controller
{

    protected $importedCommodities;
    public function __construct(ImportedCommoditiesRepository $importedCommodities)
    {
        $this->importedCommodities = $importedCommodities;
    }

    public function index()
    {
        if (request()->ajax()) {
            $query = $this->importedCommodities->fetchTable(request()); // Fetch only submission = 1

            return DataTables::of($query)
                ->editColumn('slug', function($data) {
                    return '<h4><code>' . $data->slug . '</code></h4><hr style="margin-bottom: 2px;margin-top: 2px;">
                        <small class="text-muted">Date: ' . date("M. d, Y|h:i A", strtotime($data->created_at)) . '</small>';
                })

                ->editColumn('application_type', function($data) {
                    return '<p style="font-size: small" class="no-margin">' . $data->application_type . '</p>';
                })

                ->editColumn('name', function($data) {
                    return view('admin.importedCommodities.dt.NameDetails')->with(['data' => $data]);
                })

                ->editColumn('prod_description', function($data) {
                    return view('admin.importedCommodities.dt.ProductDescription')->with(['data' => $data]);
                })

                ->editColumn('purpose_importation', function($data) {
                    return view('admin.importedCommodities.dt.PurposeImportation')->with(['data' => $data]);
                })

                ->editColumn('status', function($data) {
                    return view('admin.importedCommodities.dt.status')->with(['data' => $data]);
                })

                ->addColumn('action', function($data) {
                    return view('admin.importedCommodities.dt.action')->with(['data' => $data]);
                })

                ->rawColumns(['slug', 'importedCommodities_type', 'action'])
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }

        return view('admin.importedCommodities.index');
    }

    public function revoked()
    {
        if (request()->ajax()) {
            $query = $this->importedCommodities->fetchTableRevoked(request()); // Fetch only submission = 1

            return DataTables::of($query)
                ->editColumn('slug', function($data) {
                    return '<h4><code>' . $data->slug . '</code></h4><hr style="margin-bottom: 2px;margin-top: 2px;">
                        <small class="text-muted">Date: ' . date("M. d, Y|h:i A", strtotime($data->created_at)) . '</small>';
                })

                ->editColumn('application_type', function($data) {
                    return '<p style="font-size: small" class="no-margin">' . $data->application_type . '</p>';
                })

                ->editColumn('name', function($data) {
                    return view('admin.importedCommodities.dt-revoked.NameDetails')->with(['data' => $data]);
                })

                ->editColumn('prod_description', function($data) {
                    return view('admin.importedCommodities.dt-revoked.ProductDescription')->with(['data' => $data]);
                })

                ->editColumn('purpose_importation', function($data) {
                    return view('admin.importedCommodities.dt-revoked.PurposeImportation')->with(['data' => $data]);
                })

                ->editColumn('status', function($data) {
                    return view('admin.importedCommodities.dt-revoked.status')->with(['data' => $data]);
                })

                ->addColumn('action', function($data) {
                    return view('admin.importedCommodities.dt-revoked.action')->with(['data' => $data]);
                })

                ->rawColumns(['slug', 'importedCommodities_type', 'action'])
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }

        return view('admin.importedCommodities.revoked');
    }

    public function approved()
    {
        if (request()->ajax()) {
            $query = $this->importedCommodities->fetchTableApproved(request()); // Fetch only submission = 1

            return DataTables::of($query)
                ->editColumn('slug', function($data) {
                    return '<h4><code>' . $data->slug . '</code></h4><hr style="margin-bottom: 2px;margin-top: 2px;">
                        <small class="text-muted">Date: ' . date("M. d, Y|h:i A", strtotime($data->created_at)) . '</small>';
                })

                ->editColumn('application_type', function($data) {
                    return '<p style="font-size: small" class="no-margin">' . $data->application_type . '</p>';
                })

                ->editColumn('name', function($data) {
                    return view('admin.importedCommodities.dt-approved.NameDetails')->with(['data' => $data]);
                })

                ->editColumn('prod_description', function($data) {
                    return view('admin.importedCommodities.dt-approved.ProductDescription')->with(['data' => $data]);
                })

                ->editColumn('purpose_importation', function($data) {
                    return view('admin.importedCommodities.dt-approved.PurposeImportation')->with(['data' => $data]);
                })

                ->editColumn('status', function($data) {
                    return view('admin.importedCommodities.dt-approved.status')->with(['data' => $data]);
                })

                ->addColumn('action', function($data) {
                    return view('admin.importedCommodities.dt-approved.action')->with(['data' => $data]);
                })

                ->rawColumns(['slug', 'importedCommodities_type', 'action'])
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }

        return view('admin.importedCommodities.approved');
    }

    public function edit($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.importedCommodities.edit', compact('data'));
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
        $data->submission = 0;
        $data->revoked_date = now(); // Always update revoked_date
        $data->update();

        $ic_revoked = new ICRevoked();
        $ipAddress = $request->ip();
        $ic_revoked->slug = $data->slug;
        $ic_revoked->user_created = $data->user_created;
        $ic_revoked->submission_date = now();
        $ic_revoked->ip_created = $ipAddress;

        // Save the remarks
        $ic_revoked->remarks = $request->input('remarks'); // Store remarks from the request


        $ic_revoked->save();
        return response()->json(['success' => true, 'message' => 'Application revoked successfully']);

//        return response()->json([
//            'slug' => $data->slug,
//            'revoked' => $data->revoked,
//            'revoked_date' => $data->revoked_date,
//            'received' => $data->received
//        ]);
    }




    public function show($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.importedCommodities.show', compact('data'));
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
