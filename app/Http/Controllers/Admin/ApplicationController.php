<?php

namespace App\Http\Controllers\Admin;

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


                ->addColumn('action', function($data) {
                    $attachmentFields = [
                        'bill_landing_path' => 'Bill of Landing',
                        'commercial_invoice_path' => 'Commercial Invoice',
                        'packing_list_path' => 'Packing List',
                        'cert_origin_path' => 'Certificate of Origin',
                        'cert_analysis_path' => 'Certificate of Analysis',
                        'notarized_gmo_non_gmo_path' => 'Notarized GMO/Non-GMO',
                        'important_declaration_path' => 'Important Declaration',
                        'application_form_path' => 'Application Form',
                        'affidavit_path' => 'Affidavit'
                    ];

                    // Count non-empty attachments
                    $attachmentsCount = 0;
                    foreach ($attachmentFields as $field => $label) {
                        if (!empty($data->$field) && $data->$field !== null) {
                            $attachmentsCount++;
                        }
                    }

                    // Generate dropdown for available files
                    $dropdownMenu = '<div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span> View Files (' . $attachmentsCount . '/9)
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">';

                    foreach ($attachmentFields as $field => $label) {
                        if (!empty($data->$field) && $data->$field !== null) {
                            $fileUrl = url("/show_file_custom/imported_commodities/{$data->slug}/{$field}");
                            $dropdownMenu .= '<li><a href="' . $fileUrl . '" target="_blank"><small class="no-margin">' . $label . '</small></a></li>';
                        }
                    }

                    $dropdownMenu .= '</ul></div>';

                    // Action buttons (Edit & Delete)
                    $buttons = '<div class="btn-group">
                    <button type="button" data="' . $data->slug . '" class="btn btn-default btn-sm edit_btn" data-toggle="modal" data-target="#edit_modal" title="Edit" data-placement="top">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>';

                    // Merge buttons with dropdown
                    return $buttons . ' ' . $dropdownMenu;
                })
                ->rawColumns(['action']) // Ensure raw HTML is rendered



//                ->addColumn('action', function($data){
//                    $button = '<div class="btn-group">
//
//                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_btn" data-toggle="modal" data-target="#edit_modal" title="Edit" data-placement="top">
//                                    <i class="fa fa-edit"></i>
//                                </button>
//
//
//                            </div>';
//                    return $button;
//                })
                ->escapeColumns([])
                ->setRowId('slug')
//                ->make(true)
                ->toJson();
        }
        return view('admin.application.index');
    }

//<div class="btn-group btn-group-sm" role="group">
//<button type="button" class="btn btn-default dropdown-toggle btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//Attachments<span class="caret"></span>
//</button>
//<ul class="dropdown-menu dropdown-menu-right">
//<li><a href="/show_file_custom/imported_commodities/'.$data->slug.'/application_form_path" target="_blank" ><small class="no-margin">Application Form</small></a></li>
//</ul>
//</div>
//<button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_btn" data-toggle="tooltip" title="Delete" data-placement="top">
//<i class="fa fa-trash"></i>
//</button>

//    public function showApplicationFile($slug){
//        $data = ImportedCommodities::query()->where('slug', $slug)->first();
//        return view('admin.application.attachments.showApplicationFile')->with([
//            'data' => $data,
//        ]);
//    }

    public function getAttachmentsCount($data) {
        $attachmentFields = [
            'bill_landing_path',
            'commercial_invoice_path',
            'packing_list_path',
            'cert_origin_path',
            'cert_analysis_path',
            'notarized_gmo_non_gmo_path',
            'important_declaration_path',
            'application_form_path',
            'affidavit_path'
        ];

        // Count how many attachments are not null or empty
        $attachmentsCount = collect($attachmentFields)->filter(function ($field) use ($data) {
            return !empty($data->$field);
        })->count();

        return "{$attachmentsCount}/" . count($attachmentFields);
    }
    public function showApplicationFile($slug) {
        $data = ImportedCommodities::where('slug', $slug)->first();

        if (!$data) {
            abort(404, 'Application file not found.');
        }

        return view('admin.application.attachments.showApplicationFile', compact('data'));
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
