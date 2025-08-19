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

use App\Swep\Repositories\Admin\OrderOfPaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Log;

class OrderOfPaymentController extends Controller
{

    protected $orderOfPayment;
    public function __construct(OrderOfPaymentRepository $orderOfPayment)
    {
        $this->orderOfPayment = $orderOfPayment;
    }


    public function index()
    {
        if (request()->ajax()) {
            $query = $this->orderOfPayment->fetchTable(request()); // Fetch only submission = 1

            return DataTables::of($query)

                ->addColumn('action', function($data) {
                    return view('admin.orderOfPayment.action')->with(['data' => $data]);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }

        return view('admin.orderOfPayment.index');
    }

    public function create(){

        return view('admin.orderOfPayment.create');

    }

    public function edit($slug)
    {
        $data = OrderOfPayment::where('slug', '=', $slug)->first();
        $data1 = ImportedCommodities::where('slug', $slug)->first();
        return view('admin.orderOfPayment.edit', compact('data', 'data1'));
    }



    public function update(Request $request, $slug) {

        $app_data = OrderOfPayment::where('slug', $slug)->first();
//dd($app_data);
        if (!$app_data) {
            Log::error('Data not found', ['slug' => $slug]);
            return response()->json(['error' => 'Order not found.'], 404);
        }

        $app_data->reference_no = $request->reference_no;
        $app_data->fullname = $request->fullname;
        $app_data->company = $request->company;
        $app_data->date = $request->date;
        $app_data->amount = $request->amount;
//        $app_data->amount_in_word = $request->amount_in_word;
        $app_data->lkg_bags = $request->lkg_bags;
        $app_data->metric_tons = $request->metric_tons;
        $app_data->boc_entry_no = $request->boc_entry_no;
        $app_data->boc_entry_note = $request->boc_entry_note;
        $app_data->certified_correct = $request->certified_correct;
        $app_data->approved_by = $request->approved_by;
        $app_data->verify = true;
        $app_data->save();

        return response()->json(['slug' => $app_data->slug]);
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

}
