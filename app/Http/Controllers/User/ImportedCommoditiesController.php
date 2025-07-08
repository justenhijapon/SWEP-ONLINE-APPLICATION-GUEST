<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ImportedCommodities\ImportedCommoditiesFormRequest;
use App\Models\Admin\OrderOfPayment;
use App\Models\User;
use App\Models\User\ICSubmitted;
use App\Models\User\ImportedCommodities;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User\PreRegistrationModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpseclib3\System\SSH\Agent\Identity;
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
                                <button type="button" class="btn btn-primary btn-lg btn-outline view_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#view_modal">Print Preview</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-outline edit_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#edit_modal" title="Attachment" data-placement="top">Attachment</button>
                            </div>';
                })

                ->editColumn('name',function($data){
                    return view('dashboard.ImportedCommodities.dtNameDetails')->with([
                        'data' => $data,
                    ]);
                })
                ->editColumn('prod_description',function($data){
                    return view('dashboard.ImportedCommodities.dtProductDescription')->with([
                        'data' => $data,
                    ]);
                })
                ->editColumn('purpose_importation',function($data){
                    return view('dashboard.ImportedCommodities.dtPurposeImportation')->with([
                        'data' => $data,
                    ]);
                })
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
        $ic->created_at = Carbon::now();
        $ic->updated_at = Carbon::now();
        $ic->date = Carbon::now()->format('Y-m-d H:i:s');
        $ic->year = now()->format('Y');
        $ic->save();
    }

    public function attachmentStore(ImportedCommoditiesFormRequest $request){
        $ic = new ImportedCommodities();

         // Handle file uploads
       $ic->bill_landing_path = $this->handleFileUpload($request, 'bill_landing_path');
       $ic->commercial_invoice_path = $this->handleFileUpload($request, 'commercial_invoice_path');
       $ic->packing_list_path = $this->handleFileUpload($request, 'packing_list_path');
       $ic->cert_origin = $this->handleFileUpload($request, 'cert_origin');
       $ic->cert_analysis_path = $this->handleFileUpload($request, 'cert_analysis_path');
       $ic->notarized_gmo_non_gmo_path = $this->handleFileUpload($request, 'notarized_gmo_non_gmo_path');
       $ic->important_declaration_path = $this->handleFileUpload($request, 'important_declaration_path');
       $ic->application_form_path = $this->handleFileUpload($request, 'application_form_path');
       $ic->affidavit_path = $this->handleFileUpload($request, 'affidavit_path');
    }


    public function show($id){
        if(Auth::guard('web')->check()) {
            $data = ImportedCommodities::query()->where('slug', $id)->first();

            return view('dashboard.ImportedCommodities.show')->with([
                'data' => $data
            ]);
        }
    }

    public function printTransactionIc(Request $request){
        $data = ImportedCommodities::query()->where('slug',$request->transactionId)->first();

        return view('dashboard.ImportedCommodities.printIC')->with([
            'data'=>$data
        ]);
    }

//    public function printOrderOfPayment(Request $request, $slug)
//    {
//        $data = OrderOfPayment::where('slug', $slug)->first();
//
//        if (!$data) {
//            abort(404, 'Order of Payment not found');
//        }
//
//        return view('admin.importedCommodities.printOrderOfPayment', compact('data'));
//    }

    public function printOrderOfPayment(Request $request, $slug)
    {
        $data = OrderOfPayment::where('slug', $slug)->first();

        if (!$data) {
            abort(404, 'Order of Payment not found');
        }

        // Load the PDF view
        $pdf = Pdf::loadView('dashboard.ImportedCommodities.printOrderOfPayment', compact('data'))
            ->setPaper('A4', 'portrait'); // Set page size and orientation

        // Return as a downloadable file
        return $pdf->download('Order_of_Payment_'.$data->slug.'.pdf');
    }




//    public function edit($slug)
//    {
//        $submittedAttemp = User\ICSubmitted::where('user_created', Auth::guard('web')->user()->slug)->first();
//        $data = ImportedCommodities::where('user_created', Auth::guard('web')->user()->slug)->first();

//        return view('dashboard.ImportedCommodities.applicationForm', compact('data', 'submittedAttemp'));
//    }


   public function update(ImportedCommoditiesFormRequest $request, $slug)
    {
        $data = ImportedCommodities::where('slug', $slug)->firstOrFail(); // Use firstOrFail() for safety
        $user = Auth::guard('web')->user();
        if (!$data) {
            $data = new ImportedCommodities(); // Create a new application if none exists
        }

        // Assign values (either update existing or insert new)
        $data->date = $request->date;
        $data->name = $request->name;
        $data->company = $request->company;
        $data->designation = $request->designation;
        $data->tin = $request->tin;
        $data->contact = $request->contact;
        $data->quantity_mt = $request->quantity_mt;
        $data->bill_landing_no = $request->bill_landing_no;
        $data->prod_description = $request->prod_description;
        $data->country_origin = $request->country_origin;
        $data->port_discharge = $request->port_discharge;
        $data->purpose_importation = $request->purpose_importation;
        $data->contact_no = $request->contact_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->commodity = $request->commodity;
        $data->h_s_code = $request->h_s_code;
        $data->volume = $request->volume;
        $data->packaging = $request->packaging;
        $data->vessel_name = $request->vessel_name;
        $data->port_entry = $request->port_entry;
        $data->application_type = 'Clearance for Imported Commodities';
        $data->user_created = $user->slug;
        $data->user_updated = $user->slug;
        $data->year = now()->format('Y');
        $ipAddress = $request->ip();

        $ic_submited = new User\ICSubmitted();
//        $ic_submited->slug = $data->slug;
//        $ic_submited->user_created = $data->user_created;
//        $ic_submited->submission_date = now();
//        $ic_submited->ip_created = $ipAddress;









        // Update submission_status only if present in the request
        if ($request->has('submission')) {
            $data->submission = $request->submission;
        }

        if ($request->has('submission')) {
            $data->revoked = $request->revoked;
        }

        // Update submission_date only when submitting the application
        if ($request->has('submission_date')) {
            $ic_submited->slug = $data->slug;
        }
        if ($request->has('submission_date')) {
            $ic_submited->user_created = $data->user_created;
        }
        if ($request->has('submission_date')) {
            $ic_submited->submission_date = now();
        }
        if ($request->has('submission_date')) {
            $ic_submited->ip_created = $ipAddress;
        }

        if ($request->has('submission_date')) {
            $data->submission_date = $request->submission_date;
        }

        // If it's a new entry, set the created_at date
        if (!$data->exists) {
            $data->created_at = now();
        }



        $data->updated_at = now();
//        $data->date = $request->date->format('Y-m-d H:i:s');



        // Only update if a new file is uploaded
        if ($billLanding = $this->handleFileUpload($request, 'bill_landing_path', $slug)) {
            $data->bill_landing_path = $billLanding;
        }
        if ($invoice = $this->handleFileUpload($request, 'commercial_invoice_path', $slug)) {
            $data->commercial_invoice_path = $invoice;
        }
        if ($packingList = $this->handleFileUpload($request, 'packing_list_path', $slug)) {
            $data->packing_list_path = $packingList;
        }
        if ($certOrigin = $this->handleFileUpload($request, 'cert_origin_path', $slug)) {
            $data->cert_origin_path = $certOrigin;
        }
        if ($certAnalysis = $this->handleFileUpload($request, 'cert_analysis_path', $slug)) {
            $data->cert_analysis_path = $certAnalysis;
        }
        if ($gmoCert = $this->handleFileUpload($request, 'notarized_gmo_non_gmo_path', $slug)) {
            $data->notarized_gmo_non_gmo_path = $gmoCert;
        }
        if ($declaration = $this->handleFileUpload($request, 'important_declaration_path', $slug)) {
            $data->important_declaration_path = $declaration;
        }
        if ($appForm = $this->handleFileUpload($request, 'application_form_path', $slug)) {
            $data->application_form_path = $appForm;
        }
        if ($affidavit = $this->handleFileUpload($request, 'affidavit_path', $slug)) {
            $data->affidavit_path = $affidavit;
        }

        $data->save();
        $ic_submited->save();
//       return redirect()->back();
//        return redirect()->to('/');
        return response()->json(['slug' => $data->slug]);
    }

    private function handleFileUpload(Request $request, $fileInputName, $slug)
    {
        // Ensure the file is uploaded
        if ($request->hasFile($fileInputName)) {
            $file = $request->file($fileInputName);
            $folderPath = 'imported_commodities/' . $slug; // Store under slug folder

            // Store the file and return the path
            return $file->storeAs($folderPath, time() . '_' . $file->getClientOriginalName(), 'local');
        }

        return null; // Return null if no file was uploaded
    }



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

    public function getFilePaths($slug)
    {
        return response()->json([
            'application_form_path' => "/show_file_custom_user/imported_commodities/$slug/application_form_path",
            'affidavit_path' => "/show_file_custom/imported_commodities/$slug/affidavit_path",
            'bill_landing_path' => "/show_file_custom/imported_commodities/$slug/bill_landing_path",
            'commercial_invoice_path' => "/show_file_custom/imported_commodities/$slug/commercial_invoice_path",
            'packing_list_path' => "/show_file_custom/imported_commodities/$slug/packing_list_path",
            'cert_origin_path' => "/show_file_custom/imported_commodities/$slug/cert_origin_path",
            'cert_analysis_path' => "/show_file_custom/imported_commodities/$slug/cert_analysis_path",
            'notarized_gmo_non_gmo_path' => "/show_file_custom/imported_commodities/$slug/notarized_gmo_non_gmo_path",
            'important_declaration_path' => "/show_file_custom/imported_commodities/$slug/important_declaration_path",
        ]);
    }

}