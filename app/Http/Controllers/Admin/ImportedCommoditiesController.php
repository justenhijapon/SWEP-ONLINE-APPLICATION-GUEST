<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ApplicationFormRequest;
use App\Http\Requests\Admin\OrderOfPaymentFormRequest;
use App\Http\Requests\Admin\TransactionTypeRequest;
use App\Jobs\TestQueueJob;
use App\Mail\ApplicationApproved;
use App\Mail\ApplicationTakeBacked;
use App\Models\Admin\OrderOfPayment;
use App\Models\User\ICRevoked;
use App\Models\User\ICSubmitted;
use App\Models\User\ImportedCommodities;
use App\Models\User\TransactionType;
use App\Swep\Repositories\Admin\ImportedCommoditiesRepository;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

                ->editColumn('commodity', function($data) {
                    return view('admin.importedCommodities.dt.commodityInformation')->with(['data' => $data]);
                })

                ->editColumn('vessel_name', function($data) {
                    return view('admin.importedCommodities.dt.shippingInformation')->with(['data' => $data]);
                })

                ->editColumn('status', function($data) {
                    return view('admin.importedCommodities.dt.status')->with(['data' => $data]);
                })

                ->addColumn('action', function($data) {
                    return view('admin.importedCommodities.dt.action')->with(['data' => $data]);
                })

                ->filterColumn('name', function($query, $keyword) {
                    $query->whereRaw("CONCAT(name, ' ', company, '', email) LIKE ?", ["%{$keyword}%"]);
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

                ->editColumn('commodity', function($data) {
                    return view('admin.importedCommodities.dt-revoked.commodityInformation')->with(['data' => $data]);
                })

                ->editColumn('vessel_name', function($data) {
                    return view('admin.importedCommodities.dt-revoked.shippingInformation')->with(['data' => $data]);
                })

                ->editColumn('status', function($data) {
                    return view('admin.importedCommodities.dt-revoked.status')->with(['data' => $data]);
                })

                ->addColumn('action', function($data) {
                    return view('admin.importedCommodities.dt-revoked.action')->with(['data' => $data]);
                })


                ->filterColumn('name', function($query, $keyword) {
                    $query->whereRaw("CONCAT(name, ' ', company, '', email) LIKE ?", ["%{$keyword}%"]);
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

                ->editColumn('commodity', function($data) {
                    return view('admin.importedCommodities.dt-approved.commodityInformation')->with(['data' => $data]);
                })

                ->editColumn('vessel_name', function($data) {
                    return view('admin.importedCommodities.dt-approved.shippingInformation')->with(['data' => $data]);
                })

                ->editColumn('status', function($data) {
                    return view('admin.importedCommodities.dt-approved.status')->with(['data' => $data]);
                })

                ->addColumn('action', function($data) {
                    return view('admin.importedCommodities.dt-approved.action')->with(['data' => $data]);
                })

                ->filterColumn('name', function($query, $keyword) {
                    $query->whereRaw("CONCAT(name, ' ', company, '', email) LIKE ?", ["%{$keyword}%"]);
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
        $dataOP = OrderOfPayment::where('slug', '=', $slug)->first();
        return view('admin.importedCommodities.edit', compact('data', 'dataOP'));
    }

    public function update(Request $request, $slug) {
        $app_data = ImportedCommodities::where('slug', $slug)->firstOrFail();
        $app_data->received = $request->received;
        $app_data->received_date = now();
        $app_data->revoked = 0;
        $app_data->save();

        $op = OrderOfPayment::where('slug', '=', $slug)->first();
        $op->approve = true;
        $op->save();

        // 🔔 Send email directly to applicant (from ImportedCommodities model)
        if (!empty($app_data->email)) {
            Mail::to($app_data->email)->send(new ApplicationApproved($app_data));
        }

        return response()->json(['success' => true, 'message' => 'Application has been approved and applicant notified.']);

//        return response()->json(['slug' => $app_data->slug]);
    }

    public function orderPayment($slug)
    {
        $data = OrderOfPayment::where('slug', $slug)->first();
        $data1 = ImportedCommodities::where('slug', $slug)->first();

        if (!$data) {
            return response()->json(['error' => 'Order of Payment not found'], 404);
        }

        if (!$data1) {
            return response()->json(['error' => 'Order of Payment not found'], 404);
        }

        return view('admin.importedCommodities.orderOfPayment', compact('data', 'data1'));
    }


    public function updateOrderPayment(Request $request, $slug) {
//        Log::info('Received Slug:', ['slug' => $slug]);
//dd($slug);
        $app_data = OrderOfPayment::where('slug', $slug)->first();

        if (!$app_data) {
            Log::error('OrderOfPayment not found', ['slug' => $slug]);
            return response()->json(['error' => 'Order not found.'], 404);
        }

        $app_data->reference_no = $request->reference_no;
        $app_data->fullname = $request->fullname;
        $app_data->commodity = $request->commodity;
        $app_data->amount = $request->amount;
//        $app_data->amount_in_word = $request->amount_in_word;
        $app_data->lkg_bags = $request->lkg_bags;
        $app_data->metric_tons = $request->metric_tons;
        $app_data->boc_entry_no = $request->boc_entry_no;
        $app_data->boc_entry_note = $request->boc_entry_note;
        $app_data->certified_correct = $request->certified_correct;
        $app_data->designation_cert_correct = $request->designation_cert_correct;
        $app_data->approved_by = $request->approved_by;
        $app_data->designation_approve_by = $request->designation_approve_by;
        $app_data->date = $request->date;
        $app_data->verify = true;
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
        $ic_revoked->remarks = $request->input('remarks');
        $ic_revoked->save();


        // 🔔 Send email directly to applicant (from ImportedCommodities model)
        if (!empty($data->email)) {
            Mail::to($data->email)->send(new ApplicationTakeBacked($data, $ic_revoked->remarks));
        }

//
//        if (!empty($data->email)) {
////            $delay = Carbon::now()->addMinutes(5); // Set delay time as needed
////            Mail::to($data->email)->later($delay, new ApplicationTakeBacked($data));
//            Mail::to($data->email)->queue(
//                (new ApplicationTakeBacked($data))->delay(now()->addMinutes(1))
//            );
//        }


        return response()->json(['success' => true, 'message' => 'Application has been taken back and applicant notified.']);
    }


//    public function revokedUpdate($slug, Request $request)
//    {
//        $data = ImportedCommodities::where('slug', $slug)->firstOrFail();
//
//        // Always set revoked to 1 and received to 0
//        $data->revoked = 1;
//        $data->received = 0;
//        $data->submission = 0;
//        $data->revoked_date = now(); // Always update revoked_date
//        $data->update();
//
//        $ic_revoked = new ICRevoked();
//        $ipAddress = $request->ip();
//        $ic_revoked->slug = $data->slug;
//        $ic_revoked->user_created = $data->user_created;
//        $ic_revoked->submission_date = now();
//        $ic_revoked->ip_created = $ipAddress;
//
//        // Save the remarks
//        $ic_revoked->remarks = $request->input('remarks'); // Store remarks from the request
//
//
//        $ic_revoked->save();
//        return response()->json(['success' => true, 'message' => 'Application revoked successfully']);
//
////        return response()->json([
////            'slug' => $data->slug,
////            'revoked' => $data->revoked,
////            'revoked_date' => $data->revoked_date,
////            'received' => $data->received
////        ]);
//    }




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


    public function printOrderOfPayment($slug)
    {
        $data = OrderOfPayment::query()->where('slug','=', $slug)->first();

        return view('admin.importedCommodities.printOrderOfPayment', compact('data'));
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

    public function testQueue()
    {
        TestQueueJob::dispatch()->delay(now()->addSeconds(10));
        return 'Job dispatched!';
    }

}
