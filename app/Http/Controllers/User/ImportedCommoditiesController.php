<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ImportedCommodities\ImportedCommoditiesFormRequest;
use App\Models\User\ImportedCommodities;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class ImportedCommoditiesController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $ic = ImportedCommodities::where('user_created', Auth::guard('web')->user()->slug);
            return DataTables::of($ic)
            ->editColumn('slug',function($data){
                    return '<h4><code>'.$data->slug.'</code></h4><hr style="margin-bottom: 2px;margin-top: 2px;">
                            <small class="text-muted">Date: '.date("M. d, Y|h:i A",strtotime($data->created_at)).'</small>';
                })


                ->addColumn('action',function ($data){
                    $destroy_route = "'".route("dashboard.ImportedCommodities.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    return '<div class="btn-group" role="group" aria-label="Basic example" style="height: 45%">
                                        <button type="button" class="btn btn-success btn-lg btn-outline print_btn" data="'.$data->slug.'" id="printBtn'.$data->slug.'"><i class="fa fa-print"></i> Print</button>
                                        <button type="button" class="btn btn-secondary btn-lg btn-outline view_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#view_modal">View</button>
                                    </div>';
                })

//                <a  href="'. route('dashboard.ImportedCommodities.show', $data->slug).'"    data="'.$data->slug.'" class="btn btn-default btn-sm view_my_btn" data-toggle="modal" data-target="#view_my_modal" title="" data-placement="top" data-original-title="View">
//                                    <i class="fa fa-eye"></i>
//                                </a>
//
//                                <button class="btn btn-default btn-sm print_request_btn"  data="'.$data->slug.'" data-toggle="tooltip" title="" data-placement="top" data-original-title="Print">
//                                    <i class="fa fa-print"></i>
//                                </button>
//                ->editColumn('name',function($data){
//                    return view('dashboard.ImportedCommodities.dtNameDetails')->with([
//                        'data' => $data,
//                    ]);
//                })
//                ->editColumn('productDescription',function($data){
//                    return view('dashboard.ImportedCommodities.dtProductDescription')->with([
//                        'data' => $data,
//                    ]);
//                })
//                ->editColumn('purposeImportation',function($data){
//                    return view('dashboard.ImportedCommodities.dtPurposeImportation')->with([
//                        'data' => $data,
//                    ]);
//                })
//                ->editColumn('message',function ($data){
//                    return Str::limit($data->message,100,'...');
//                })
                ->setRowId('slug')
                ->escapeColumns([])
                ->toJson();
        }
        return view('dashboard.ImportedCommodities.index');
    }



    public function create(){

        return view('dashboard.ImportedCommodities.create');

    }

    public function store(ImportedCommoditiesFormRequest $request)
    {

        $ic = new ImportedCommodities();
//        $ic->slug = Str::random(15);
        $ic->slug = strtoupper($this->hyphenate(str_shuffle(str_random(5) . rand(1000, 9999)))) . '-' . date('my');
        $ic->name = $request->name;
        $ic->company = $request->company;
        $ic->designation = $request->designation;
        $ic->tin = $request->tin;
        $ic->contact = $request->contact;
        $ic->quantity_mt = $request->quantity_mt;
        $ic->bill_landing_no = $request->bill_landing_no;
        $ic->prod_description = $request->prod_description;
        $ic->country_origin = $request->country_origin;
        $ic->port_discharge = $request->port_discharge;
        $ic->purpose_importation = $request->purpose_importation;
        $ic->contact_no = $request->contact_no;
        $ic->email = $request->email;
        $ic->address = $request->address;
        $ic->application_type = 'Clearance for Imported Commodities';

        $ic->user_created = Auth::guard('web')->user()->slug;
        $ic->user_updated = Auth::guard('web')->user()->slug;


        // Handle file uploads
//        $ic->bill_landing_path = $this->handleFileUpload($request, 'bill_landing_path');
//        $ic->commercial_invoice_path = $this->handleFileUpload($request, 'commercial_invoice_path');
//        $ic->packing_list_path = $this->handleFileUpload($request, 'packing_list_path');
//        $ic->cert_origin = $this->handleFileUpload($request, 'cert_origin');
//        $ic->cert_analysis_path = $this->handleFileUpload($request, 'cert_analysis_path');
//        $ic->notarized_gmo_non_gmo_path = $this->handleFileUpload($request, 'notarized_gmo_non_gmo_path');
//        $ic->important_declaration_path = $this->handleFileUpload($request, 'important_declaration_path');
//        $ic->application_form_path = $this->handleFileUpload($request, 'application_form_path');
//        $ic->affidavit_path = $this->handleFileUpload($request, 'affidavit_path');


        $ic->created_at = Carbon::now();
        $ic->updated_at = Carbon::now();
        $ic->date = Carbon::now()->format('Y-m-d H:i:s');
        $ic->year = now()->format('Y');
        $ic->save();

    }


    // Helper method to handle file uploads
    private function handleFileUpload($request, $fileInputName)
    {
        if ($request->hasFile($fileInputName)) {
            $file = $request->file($fileInputName);
            return $file->storeAs('imported_commodities', time() . '_' . $file->getClientOriginalName(), 'public');
        }
        return null; // Return null if no file was uploaded for this input
    }



//    public function show($slug){
//        $data = ImportedCommodities::query()->where('slug',$slug)->first();
//
//        return view('dashboard.ImportedCommodities.show')->with([
//            'data'=>$data
//        ]);
//    }

    public function show(Request $request){
        $data = ImportedCommodities::query()->where('slug',$request->transactionId)->first();

        return view('dashboard.ImportedCommodities.printIC')->with([
            'data'=>$data
        ]);
    }

    public function printTransactionIc(Request $request){
        $data = ImportedCommodities::query()->where('slug',$request->transactionId)->first();

        return view('dashboard.ImportedCommodities.printIC')->with([
            'data'=>$data
        ]);
    }

//    public function printTransactionIc($slug)
//    {
//        $data = ImportedCommodities::where('slug', $slug)->firstOrFail();
//
//        return view('dashboard.ImportedCommodities.printIC', compact('data'));
//    }

    public function changeStatus($slug, \Illuminate\Http\Request $request){
        $template = ImportedCommodities::query()->where('slug','=',$slug)->first();
        if(!empty($template)){
            $template->status = ($request->active == 'true') ? 'read' : 'new' ;
            $template->update();
            return $template->only('slug');
        }else{
            abort(500,'Error Posting!');
        }
    }

    private function hyphenate(string $str)
    {
        return implode("-", str_split($str, 3));
    }


}