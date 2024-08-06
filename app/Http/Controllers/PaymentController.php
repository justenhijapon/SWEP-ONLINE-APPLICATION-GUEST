<?php


namespace App\Http\Controllers;


use App\Http\Requests\User\PaymentFormRequest;
use App\Models\User;
use App\Models\User\LabAnalysis;
use App\Models\User\OrderOfPayments;
use App\Models\User\OrderOfPaymentsDetailsModel;
use App\Models\User\SupportingDocuments;
use App\Models\User\SucroseContentModel;
use App\Models\User\TransactionType;
use App\Swep\Repositories\User\LabAnalysisRepository;
use App\Swep\Services\User\UserService;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    protected $labAnalysisRepo;
    protected $user_repo;
    protected $userService;
    public function __construct(LabAnalysisRepository $labAnalysisRepo, UserService $userService)
    {
        $this->labAnalysisRepo = $labAnalysisRepo;
        $this->userService = $userService;
        parent::__construct();
    }

    public function printTransaction(Request $request){
        $op = OrderOfPayments::where('slug', $request->transactionId)->first();
        $client = User::where('slug', $op->client_slug)->first();
        $opDetails = User\OrderOfPaymentsDetailsModel::where('order_of_payments_slug', $op->slug)->get();
        return view('dashboard.payment.printTrans')->with(['op' => $op, 'client' => $client, 'opDetails' => $opDetails]);
    }

    public function printTransactionReport(Request $request){
        $op = OrderOfPayments::whereBetween('created_at', [$request->from, $request->to])->get();
        return view('admin.home.printTrans')->with(['op' => $op, 'from' => $request->from, 'to' => $request->to]);
    }

    public function printTransactionReportDaily(Request $request){
        $op = OrderOfPayments::whereDate('created_at', $request->daily)->get();
        return view('admin.home.printTransDaily')->with(['op' => $op, 'daily' => $request->daily]);
    }

    public function printTransactionReportClient(Request $request){
        $op = OrderOfPayments::where('client_slug', $request->client)->get();
        $client = User::where('slug', $request->client)->first();
        return view('admin.home.printTransClient')->with(['op' => $op, 'client' => $client]);
    }



    public function index(){
        if(request()->ajax()){
            $order_of_payments = OrderOfPayments::where('user_created',Auth::guard('web')->user()->slug);
            if(!empty(request()->status)){
                if(request()->status == 'Active'){
                    $order_of_payments = $order_of_payments->where('expires_on' ,'>', Carbon::now());
                }
                if(request()->status == 'Expired'){
                    $order_of_payments = $order_of_payments->where('expires_on' ,'<=', Carbon::now());
                }
            }

            if(!empty(request()->transaction_type)){
                if(request()->transaction_type != 'All'){
                    $order_of_payments = $order_of_payments->where('transaction_type',request()->transaction_type);
                }
            }

            return DataTables::of($order_of_payments)

                ->editColumn('slug',function($data){
                    return '<h4><code>'.$data->slug.'</code></h4><hr style="margin-bottom: 2px;margin-top: 2px;">
                            <small class="text-muted">Date: '.date("M. d, Y|h:i A",strtotime($data->created_at)).'</small>
                            <br>
                            <small class="text-muted">Expires on: '.date("M. d, Y|h:i A",strtotime($data->expires_on)).'</small>';
                })
                ->editColumn('total_amount', '{{number_format($total_amount,2)}}')
                ->addColumn('status', function($data){
                    if($data->expires_on <= Carbon::now()){
                        return '<div class="badge badge-danger">Expired</div>';
                    }else{
                        return '<div class="badge badge-primary">'.$data->status.'</div>';
                    }
                })
                ->addColumn('action',function($data){
//                    return '<div class="btn-group" role="group" aria-label="Basic example" style="height: 45%">
//                            <button type="button" class="btn btn-light btn-lg btn-outline" data="'.$data->slug.'"><i class="fa fa-eye"></i> View</button>
//                            <button type="button" class="btn btn-light btn-lg">Other</button>
//                          </div>';
                    if($data->expires_on > Carbon::now()){
                        /*if($data->status == "FOR APPROVAL"){
                            return '<div class="btn-group" role="group" aria-label="Basic example" style="height: 45%">
                                <button type="button" class="btn btn-success btn-lg btn-outline print_btn" data="'.$data->slug.'" id="printBtn'.$data->slug.'"><i class="fa fa-print"></i> Print</button>
                                <button type="button" class="btn btn-success btn-lg btn-outline payNow_btn" data="'.$data->slug.'"><i class="fa fa-rub"></i> Pay Now</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-outline view_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#view_modal">View</button>
                            </div>';
                        }*/
                            return '<div class="btn-group" role="group" aria-label="Basic example" style="height: 45%">
                                        <button type="button" class="btn btn-success btn-lg btn-outline print_btn" data="'.$data->slug.'" id="printBtn'.$data->slug.'"><i class="fa fa-print"></i> Print</button>
                                        <button type="button" class="btn btn-secondary btn-lg btn-outline view_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#view_modal">View</button>
                                    </div>';
                    }
                })
                ->setRowClass(function($data){
                    if($data->expires_on <= Carbon::now()){
                        return 'table-muted';
                    }
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('dashboard.payment.index');
    }

    public function create(){
        /*if(!empty($transaction_type_db)){
            foreach ($transaction_type_db as $transaction_type_db){
                $transaction_types[$transaction_type_db->group][$transaction_type_db->transaction_code] = [
                    'transaction_code' => $transaction_type_db->transaction_code,
                    'transaction_type' => $transaction_type_db->transaction_type,
                    'type' => $transaction_type_db->type,
                    'amount' => $transaction_type_db->amount,
                ];
            }
        }*/

        $transaction_type_group_db = User\TransactionTypeGroup::get();
        $transaction_types_group = [];
        if(!empty($transaction_type_group_db)){
            foreach($transaction_type_group_db as $transaction_type_group_db){
                $transaction_types_group[$transaction_type_group_db->slug] = [
                    'slug' => $transaction_type_group_db->slug,
                    'group_name' => $transaction_type_group_db->name,
                ];
            }
        }

        $sucrose_content_db = SucroseContentModel::get()->first();
        return view('dashboard.payment.create')->with(['sucrose_contents' => $sucrose_content_db, 'transaction_types_group' => $transaction_types_group]);
    }

    public function groupSelected($id) {
        //$transaction_type_db = TransactionType::get();
        $transaction_type_db = TransactionType::get()->where('transaction_types_group_slug', '=', $id);
        $transaction_types = [];
        if(!empty($transaction_type_db)){
                foreach ($transaction_type_db as $transaction_type_db){
                    $transaction_types[$transaction_type_db->transaction_types_group_slug][$transaction_type_db->slug] = [
                        'transaction_code' => $transaction_type_db->slug,
                        'transaction_type' => $transaction_type_db->name,
                        'group' => $transaction_type_db->transaction_types_group_slug,
                        'unit' => $transaction_type_db->unit,
                        'fee_per_unit' => $transaction_type_db->fee_per_unit,
                        'regular_fee' => $transaction_type_db->regular_fee,
                        'expedite_fee' => $transaction_type_db->expedite_fee,
                    ];
                }
        }
        return view('dashboard.payment.transactionTypeGroup')->with(['transaction_types' => $transaction_types]);
    }

    public function getLabAnalysisTypes($id){
        $transaction_types_lab_analysis_db = User\TransactionTypesLabAnalysis::get()->where('transaction_type_slug', '=', $id);
        return view('dashboard.payment.labAnalysisTypes')->with(['transaction_types_lab_analysis' => $transaction_types_lab_analysis_db, 'iD' => $id]);
    }

    public function getLabAnalysis(){
        $lab_analysis_db = LabAnalysis::get()->where('user_slug', '=', $this->auth->guard('web')->user()->slug);
        $lab_analysis = [];
        if(!empty($lab_analysis_db)){
            foreach($lab_analysis_db as $lab_analysis_db){
                $lab_analysis[$lab_analysis_db->slug] = [
                    'slug' => $lab_analysis_db->slug,
                    'user_slug' => $lab_analysis_db->user_slug,
                    'product_description' => $lab_analysis_db->product_description,
                    'sucrose' => $lab_analysis_db->sucrose,
                ];
            }
        }
        return view('dashboard.payment.labAnalysis')->with(['lab_analysis' => $lab_analysis]);
    }

    public function validateForm(){
        $request = request();
        $status_code = 404;
        $errors = [];

        //Validate transaction type
        if(!$request->has('transaction_code')){                                                                     //IF TRANSACTION TYPE IS NOT SET
            $status_code = 422;
            $errors['message'] = 'Please select transaction';
        }else{
            $transaction_type_db = TransactionType::where('slug',$request->transaction_code)->first();
            if(empty($transaction_type_db)){                                                                            //IF TRANSACTION IS NOT FOUND IN DATABASE
                $status_code = 422;
                $errors['message'] = 'SRA does not offer this transaction';
            }else{
                $type = $transaction_type_db->unit;
                //if($type != 'STATIC'){
                //    if($request->volume == 0 || $request->volume == null){
                 //       $status_code = 422;
                //        $errors['message'] = 'Please provide volume.';
                 //   }
                //}
                if($status_code == 404){
                    $request->transaction_type = $transaction_type_db->name;
                    return $this->review($request);
                }
            }
        }

        if($status_code == 200){
            return 1;
        }else{
            return response()->json([
                'message'=>$errors
            ], $status_code);
        }
    }

    public function review(Request $request){
        $transactionType = TransactionType::where('slug', $request->transaction_code)->get()->first();
        $unit = $transactionType->unit;
        $labAnalysisSlug = $request->LabAnalysisName;
        $labAnalysisRepo = $this->labAnalysisRepo->findBySlug($labAnalysisSlug);
        $transaction_code = $request->transaction_code;
        $payment_method = 'Landbank LinkBiz Portal';
        $amount = 0;
        $volume = 0;

        $premixProduct = [];
        if($request->transaction_code == "PRE"){
            if(empty($request->tdID)){
                $errors['message'] = 'Please make sure to click the plus (+) button after selecting the product and please provide volume.';
                return response()->json([
                    'message'=>$errors
                ], 422);
            }
            else {
                foreach($request->tdID as $key=>$tdID){
                    if($request->tdVolume[$key] == null){
                        $request->tdVolume[$key] = 0;
                    }
                    $requestAmount = $request->tdAmount[$key];
                    $amount += $requestAmount;
                    $volume += $request->tdVolume[$key];
                    $premixProduct[$tdID] = [
                        'tdID' => $tdID,
                        'tdProduct' => $request->tdNames[$key],
                        'tdVolume' => $request->tdVolume[$key],
                        'tdAmount' => $requestAmount,
                    ];
                }
            }
        }

        $response = collect();
        if($request->transaction_code != "PRE") {
            if(!empty($request->volume)){
                $response->volume = $request->volume;
            }
            $amount = $this->amountComputer($transaction_code, $request->volume, $request->amount, $labAnalysisSlug);
        }

        if(!empty($labAnalysisRepo)){
            $response->product = $labAnalysisRepo->product_description;
        }

        $response->unit = $unit;
        $response->transaction_types_group = $request->transaction_types_group;
        $response->transaction_type = $request->transaction_type;
        $response->amount = $amount;
        $response->totalVolume = $volume;
        $response->payment_method = $payment_method;
        $response->transaction_code = $request->transaction_code;

        $transactionTypesLabAnaly = [];
        if(!empty($request->tdLabSlugs)) {
            foreach($request->tdLabSlugs as $key1=>$tdLabSlugs){
                $amount += $request->tdLabFees[$key1];
                $response->amount += $request->tdLabFees[$key1];
                $transactionTypesLabAnaly[$key1] = [
                    'isExpedite' => $request->isExpedite[$key1],
                    'slug' => $tdLabSlugs,
                    'name' => $request->tdLabNames[$key1],
                    'amount' => $request->tdLabFees[$key1],
                ];
            }
        }
        return view('dashboard.payment.review')->with(['response'=>$response, 'premixProduct'=>$premixProduct, 'transactionTypesLabAnalysis'=>$transactionTypesLabAnaly]);
    }

    public function show($id){
        if(Auth::guard('web')->check()){
            $op = OrderOfPayments::where('slug',$id)->first();
            $opDetails = User\OrderOfPaymentsDetailsModel::where('order_of_payments_slug', $op->slug)->get();
            return view('dashboard.payment.show')->with(['op' => $op, 'opDetails' => $opDetails]);
        }
    }

    public function store(PaymentFormRequest $request){
        if(!$request->has('transaction_code') || $request->transaction_code == null){
            return [
                'message' => "Invalid Transaction1",
            ];
        }else {
            $transaction_code = $request->transaction_code;
            $user_id = Auth::guard('web')->user()->slug;
            $clientName = Auth::guard('web')->user()->first_name." ".Auth::guard('web')->user()->last_name;
            $payment_method = "LANDBANK LINKBIZ PORTAL"; //$request->payment_method;

            $transaction_type_db = TransactionType::where('slug', $transaction_code)->first();

            if (empty($transaction_type_db)) {
                return [
                    'message' => "Invalid Transactions",
                ];
            }
            if (count($request->file('files')) > 0) {
                $payment = New OrderOfPayments;
                $payment->slug = strtoupper($this->hyphenate(str_shuffle(str_random(5) . rand(1000, 9999)))) . '-' . date('my');
                $payment->transaction_type_slug = $transaction_type_db->slug;
                $payment->transaction_type = $transaction_type_db->name;
                $payment->payment_method = $payment_method;
                $volume = 0;
                if($request->transaction_code == "PRE"){
                    $volume = $request->totalVolume;
                }
                else {
                    $volume = $request->volume;
                }
                $payment->total_volume = $volume;
                $payment->total_amount = $request->amount;
                $payment->status = "FOR APPROVAL";
                $payment->expires_on = Carbon::now()->addDays(3);
                $payment->client_slug = Auth::guard('web')->user()->slug;
                $payment->user_created = Auth::guard('web')->user()->slug;
                $payment->user_updated = Auth::guard('web')->user()->slug;

                if ($payment->save()) {
                    $id = $payment->id;
                    foreach ($request->file('files') as $file) {
                        $client_original_filename = $file->getClientOriginalName();
                        $path = $user_id . '/[' . $id . ']-' . $client_original_filename;
                        if ($file->storeAs($user_id, '[' . $id . ']-' . $client_original_filename)) {
                            $sd = New SupportingDocuments;
                            $sd->transaction_id = $payment->slug;
                            $sd->path = $path;
                            $sd->created_at = Carbon::now();
                            $sd->user_created = $user_id;
                            $sd->save();
                        }
                    }
                    $landBankPortal = $this->payToLandbank($payment->total_amount, $payment->slug, Auth::guard('web')->user()->business_name, $payment->transaction_type, Auth::guard('web')->user()->email);
                   //$this->userService->sendEmailAfterTransaction("$clientName", "$user_id", Auth::guard('web')->user()->email, $transaction_type_db->name);
                    return ['errorCode' => $landBankPortal[0], 'url' => $landBankPortal[1], 'message'=>$landBankPortal[2],
                        'status' => 1,
                        'transaction_id' => $payment->slug,
                        'transaction_types_group' => $request->transaction_types_group,
                        'transaction_code' => $transaction_code,
                        'amount' => number_format($payment->total_amount,2),
                        'timestamp' => date('M d, Y | h:i:A', strtotime($payment->created_at)
                        )
                    ];
                }
            } else {
                return [
                    'message' => 'Please attach supporting documents.',
                ];
            }
        }
        exit();
    }

    public function payToLandbank($amount, $transactionID, $client, $transationType, $email){
        $trxnamt = $amount;
        $merchantcode = '0495';
        $trxndetails = 'SRA ROPP';
        $trandetail1 = $transactionID;
        $trandetail2 = $client;
        $trandetail3 = $transationType;
        $trandetail4 = $email;
        $trandetail5 = 0;
        $trandetail6 = 0;
        $trandetail7 = 0;
        $trandetail8 = 0;
        $trandetail9 = 0;
        $trandetail10 = 0;
        $trandetail11 = 0;
        $trandetail12 = 0;
        $trandetail13 = 0;
        $trandetail14 = 0;
        $trandetail15 = 0;
        $trandetail16 = 0;
        $trandetail17 = 0;
        $trandetail18 = 0;
        $trandetail19 = 0;
        $trandetail20 = 0;
        $username = 'username';
        $password = 'password';
        $secretKey = 'N\HWJUKFHQX';

        $data = $trxnamt.$merchantcode.$trxndetails.$trandetail1.$trandetail2.$trandetail3.$trandetail4.$trandetail5.$trandetail6.$trandetail7.$trandetail8.$trandetail9.$trandetail10.$trandetail11.$trandetail12.$trandetail13.$trandetail14.$trandetail15.$trandetail16.$trandetail17.$trandetail18.$trandetail19.$trandetail20.$username.$password.$secretKey;

        //HASH CONCATENATED REQUEST
        $hashed = hash('sha256',$data);
        $url = 'http://222.127.109.129:8080/LBP-LinkBiz-RS/rs/postpayment';

        $concat =
            'trxnamt='.$amount .'&'.
            'merchantcode=0495&'.
            'bankcode=B000&'.
            'trxndetails=SRA ROPP&'.
            'trandetail1='.$transactionID .'&'.
            'trandetail2='. $client .'&'.
            'trandetail3='.$transationType .'&'.
            'trandetail4='. $email .'&'.
            'trandetail5='. 0 .'&'.
            'trandetail6='. 0 .'&'.
            'trandetail7='. 0 .'&'.
            'trandetail8='. 0 .'&'.
            'trandetail9='. 0 .'&'.
            'trandetail10='. 0 .'&'.
            'trandetail11='. 0 .'&'.
            'trandetail12='. 0 .'&'.
            'trandetail13='. 0 .'&'.
            'trandetail14='. 0 .'&'.
            'trandetail15='. 0 .'&'.
            'trandetail16='. 0 .'&'.
            'trandetail17='. 0 .'&'.
            'trandetail18='. 0 .'&'.
            'trandetail19='. 0 .'&'.
            'trandetail20='. 0 .'&'.
            'username=username&'.
            'password=password&'.
            'secretKey=N\HWJUKFHQX&'.
            'callbackurl=http://srawebportal.ph/dashboard/payments/create';

        $concat = ltrim($concat, '&');
        //CONCATENATED WITH =& SEPARATOR  with checksum,username,password params
        $concat = $concat.'&checksum='.$hashed;

        //POST DATA
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $concat);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec( $ch );
        $link = substr($response, strpos($response, "|") + 1);
        $responseCode = explode("|", $response)[0];



        $message = $this->message($responseCode);
        return [$responseCode, $link, $message];
    }

    public function message($errorCode){
        switch($errorCode) {
            case('00'):
                $msg = 'Thank you! Please continue paying using the newly opened Landbank Portal page.';
                break;
            case('24'):
                $msg = 'Reference number not found.';
                break;
            case('37'):
                $msg = 'Invalid Fee Amount';
            default:
                $msg = 'Something went wrong.';
        }
        return $msg;
    }

    public function orderOfPaymentsDetails(Request $request, $id){
        if(!empty($request->tdLabSlugs)){
            foreach($request->tdLabSlugs as $key=>$tdLabSlugs){
                $oOP = new OrderOfPaymentsDetailsModel();
                $oOP->order_of_payments_slug = $id;
                $oOP->lab_analysis_type = $request->tdLabNames[$key];
                $oOP->is_expedite = $request->isExpedite[$key]=="TRUE"?true:false;
                $oOP->amount =  $request->tdLabFees[$key];
                $oOP->created_at = Carbon::now();
                $oOP->user_created = Auth::guard('web')->user()->slug;
                $oOP->updated_at = Carbon::now();
                $oOP->save();
            }
        }
        elseif (!empty($request->tdID)){
            foreach($request->tdID as $key=>$tdID){
                $oOP = new OrderOfPaymentsDetailsModel();
                $oOP->order_of_payments_slug = $id;
                $oOP->product = $request->tdNames[$key];
                $oOP->volume =  $request->tdVolume[$key];
                $oOP->amount =  $request->tdAmount[$key];
                $oOP->created_at = Carbon::now();
                $oOP->user_created = Auth::guard('web')->user()->slug;
                $oOP->updated_at = Carbon::now();
                $oOP->save();
            }
        }
        exit();
    }

    public function landBank($id){
        $order_of_payments = OrderOfPayments::where('slug',$id)->first();
        $user = User::where('slug',$order_of_payments->user_created)->first();
        return view('dashboard.landBank')->with(['response'=>$order_of_payments, 'user'=>$user]);
    }

    public function getTransaction(Request $request){
        $order_of_payments = OrderOfPayments::where('slug',$request->transactionID)->first();
        $user = User::where('slug',$order_of_payments->user_created)->first();
        return view('verification')->with(['response'=>$order_of_payments,'user'=>$user]);
    }

    public function view_file(){
        if(!empty(request()->file)){
            $file = SupportingDocuments::with('orderOfPayment')->find(request()->file);
            if($file->count() > 0){
                $user = Auth::guard('web')->user()->slug;
                $owner_of_file = $file->orderOfPayment->user_created;
                if($user != $owner_of_file){
                    abort(404);
                }
                $path = "C:/swep_rd_storage/uploaded_documents/".$file->path;
                if(!File::exists($path)){
                    abort(500);
                }

                $file = File::get($path);
                $type = File::mimeType($path);
                $response = response()->make($file, 200);
                $response->header("Content-Type", $type);
                $response->header('Content-Disposition', 'filename="downloaded.pdf"');
                return $response;
            }else{
                abort(404);
            }
        }else {
            abort(404);
        }
    }

    private function hyphenate($str) {
        return implode("-", str_split($str, 3));
    }
    private function standardInt($val){
        $val = str_replace('PHP','',$val);
        $val = str_replace(',','',$val);
        return $val;
    }

    private function amountComputer($code,$volume,$amount,$labAnalysisSlug){
        $transaction_type_db = TransactionType::where('slug',$code)->first();
        $lab_analysis_db = LabAnalysis::where('slug',$labAnalysisSlug)->first();
        $sucrose_content_db = SucroseContentModel::get()->first();
        if(empty($transaction_type_db)){
            return 'message';
        }else{
            $amount = $transaction_type_db->regular_fee;
            if($transaction_type_db->unit != 'STATIC'){
                if($transaction_type_db->unit != 'APPLICATION'){
                    if($transaction_type_db->slug == 'PRE'){
                        if($lab_analysis_db->sucrose == 0){
                            $amount = 300;
                        }
                        else if($lab_analysis_db->sucrose > 0 && $lab_analysis_db->sucrose <= $sucrose_content_db->base_percentage){
                            $amount = $volume*$sucrose_content_db->below_price;
                        }
                        else if ($lab_analysis_db->sucrose > 0 && $lab_analysis_db->sucrose > $sucrose_content_db->base_percentage) {
                            $amount = $volume*$sucrose_content_db->above_price;
                        }
                    }
                    else {
                        $amount = $volume*$transaction_type_db->fee_per_unit;
                    }
                }
            }
        }
        return $amount;
    }
}