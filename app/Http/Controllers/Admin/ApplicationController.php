<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TransactionTypeRequest;
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

    public function index(){
        if(request()->ajax())
        {
            $data = request();
            return DataTables::of($this->application->fetchTable($data))
                ->editColumn('slug',function($data){
                    return '<h4><code>'.$data->slug.'</code></h4><hr style="margin-bottom: 2px;margin-top: 2px;">
                            <small class="text-muted">Date: '.date("M. d, Y|h:i A",strtotime($data->created_at)).'</small>';
                })

                ->editColumn('application_type',function($data){
                    return '<p style="font-size: small" class="no-margin">'.$data->application_type.'</p>
                            ';
                })

                ->editColumn('name',function($data){
                    return view('admin.application.dt.NameDetails')->with([
                        'data' => $data,
                    ]);
                })

                ->editColumn('prod_description',function($data){
                    return view('admin.application.dt.ProductDescription')->with([
                        'data' => $data,
                    ]);
                })
                ->editColumn('purpose_importation',function($data){
                    return view('admin.application.dt.PurposeImportation')->with([
                        'data' => $data,
                    ]);
                })


                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_btn" data-toggle="modal" data-target="#edit_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $button;
                })
                ->escapeColumns([])
                ->setRowId('slug')
//                ->make(true)
                ->toJson();
        }
        return view('admin.application.index');
    }

    public function edit($slug)
    {
        $transaction_type_db = TransactionType::where('slug', '=', $slug)->first();
        return view('admin.transactionType.edit')->with(['transactionType' => $transaction_type_db]);
    }

    public function update(TransactionTypeRequest $request, $slug) {
        $transaction_type_db = TransactionType::where('slug', '=', $slug)->first();
        $transaction_type_db->name = $request->name;
        $transaction_type_db->transaction_types_group_slug = $request->group;
        $transaction_type_db->unit = $request->unit;
        $transaction_type_db->fee_per_unit = $request->feePerUnit;
        $transaction_type_db->regular_fee = $request->regularFee;
        $transaction_type_db->expedite_fee = $request->expediteFee;
        $transaction_type_db->save();
    }

    public function destroy($slug) {
        $transaction_type_db = TransactionType::where('slug', '=', $slug)->first();
        $transaction_type_db->destroy();
    }

    public function store(Request $request) {
        $transaction_type = new TransactionType();
        $transaction_type->slug = $request->slug;
        $transaction_type->name = $request->name;
        $transaction_type->transaction_types_group_slug = $request->group;
        $transaction_type->unit = $request->unit;
        $transaction_type->fee_per_unit = $request->feePerUnit;
        $transaction_type->regular_fee = $request->regularFee;
        $transaction_type->expedite_fee = $request->expediteFee;
        $transaction_type->save();
    }
}
