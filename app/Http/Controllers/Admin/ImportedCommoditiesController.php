<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ApplicationFormRequest;
use App\Http\Requests\Admin\TransactionTypeRequest;
use App\Models\Admin\OrderOfPayment;
use App\Models\User\ICRevoked;
use App\Models\User\ICSubmitted;
use App\Models\User\ImportedCommodities;
use App\Models\User\TransactionType;
use App\Swep\Repositories\Admin\ImportedCommoditiesRepository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Log;

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

                ->filterColumn('name', function($query, $keyword) {
                    $query->whereRaw("CONCAT(imported_commodoties.name, ' ', company.name) LIKE ?", ["%{$keyword}%"]);
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

    public function orderPayment($slug)
    {
        $data = OrderOfPayment::where('slug', $slug)->first();

        if (!$data) {
            return response()->json(['error' => 'Order of Payment not found'], 404);
        }

        return view('admin.importedCommodities.orderOfPayment', compact('data'));
    }

//    public function updateOrderPayment(Request $request, $slug) {
//        $app_data = OrderOfPayment::where('slug', $slug)->firstOrFail();
////        $app_data = OrderOfPayment::where('slug', $slug)->first();
//        $app_data->reference_no = $request->reference_no;
//        $app_data->fullname = $request->fullname;
//        $app_data->company = $request->company;
//        $app_data->amount = $request->amount;
//        $app_data->amount_in_word = $request->amount_in_word;
//        $app_data->lkg_bags = $request->lkg_bags;
//        $app_data->metric_tons = $request->metric_tons;
//        $app_data->boc_entry_no = $request->boc_entry_no;
//        $app_data->boc_entry_note = $request->boc_entry_note;
//        $app_data->certified_correct = $request->certified_correct;
//        dd($slug);
//        $app_data->save();
//        return response()->json(['slug' => $app_data->slug]);
//    }



    public function updateOrderPayment(Request $request, $slug) {
        Log::info('Received Slug:', ['slug' => $slug]);

        $app_data = OrderOfPayment::where('slug', $slug)->first();

        if (!$app_data) {
            Log::error('OrderOfPayment not found', ['slug' => $slug]);
            return response()->json(['error' => 'Order not found.'], 404);
        }

        $app_data->reference_no = $request->reference_no;
        $app_data->fullname = $request->fullname;
        $app_data->company = $request->company;
        $app_data->amount = $request->amount;
        $app_data->amount_in_word = $request->amount_in_word;
        $app_data->lkg_bags = $request->lkg_bags;
        $app_data->metric_tons = $request->metric_tons;
        $app_data->boc_entry_no = $request->boc_entry_no;
        $app_data->boc_entry_note = $request->boc_entry_note;
        $app_data->certified_correct = $request->certified_correct;
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


    public function orderOfPayment($slug)
    {
        $data = ImportedCommodities::where('slug', '=', $slug)->first();
        return view('admin.importedCommodities.edit', compact('data'));
    }

//    public function printOrderOfPayment(Request $request){
//        $data = ImportedCommodities::query()->where('slug',$request->transactionId)->first();
//
//        return view('admin.ImportedCommodities.printable.printOrderOfPayment')->with([
//            'data'=>$data
//        ]);
//    }

    public function printOrderOfPayment($slug)
    {
        $data = OrderOfPayment::query()->where('slug','=', $slug)->first();

        return view('admin.ImportedCommodities.printOrderOfPayment', compact('data'));
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
