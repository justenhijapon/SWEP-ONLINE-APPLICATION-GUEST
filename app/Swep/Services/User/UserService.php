<?php
 
namespace App\Swep\Services\User;


use App\Models\User;
use App\Swep\BaseClasses\Admin\BaseService;
use App\Swep\Repositories\User\UserRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Yajra\DataTables\Facades\DataTables;

class UserService extends BaseService{



    protected $user_repo;
    protected $user;


    public function __construct(User $user, UserRepository $user_repo){
        $this->user_repo = $user_repo;
    }


    public function fetchTable($data){
        return $this->user_repo->fetchTable($data);
    }

//    public function fetchTable($data){
//       $get = $this->user_repo;
//       return $get->all();
//    }



//    public function fetchTable(Request $request)
//    {
//        $query = User::query()
//            ->orderByRaw("CASE WHEN is_online = 1 THEN 1 ELSE 2 END")
//            ->orderByDesc('last_activity');
//
//        return DataTables::of($query)
//            ->editColumn('is_online', function($data) {
//                if ($data->is_online) {
//                    return '<span class="badge bg-success">ONLINE</span>';
//                } else {
//                    $lastActivity = $data->last_activity
//                        ? Carbon::parse($data->last_activity)->diffForHumans()
//                        : 'Unknown';
//                    return '<span class="badge bg-secondary">Active <br> <strong>' . $lastActivity . '</strong></span>';
//                }
//            })
//            ->rawColumns(['is_online']) // Allows rendering of HTML in DataTables
//            ->make(true);
//    }


//    public function fetchTable($data)
//    {
//        return User::query()
////            ->orderByRaw("CASE WHEN is_online = 1 THEN 1 ELSE 2 END")
//            ->orderByDesc('last_activity')
//            ->get();
//    }


    public function fetch($slug){

    }

    public function store($request){
        $new_slug = $this->new_slug();
        while ($new_slug == 0) {
            $new_slug = $this->new_slug();
        }
        $request->request->add(['slug' => $new_slug]);

        $user = $this->user_repo->store($request);
        if($user){
            $uev = $this->user_repo->storeEmailVerification($user->slug);
            if($uev){
                $send_mail = $this->sendEmailVerification($user->first_name, $user->slug,$user->email ,$uev->verification_slug);
                if($send_mail == 1){
                    return 1;
                }else{
                    $this->user_repo->destroy($user->slug);
                    return response()->json([
                        'message' => "Error sending email verification",
                        'trace' => $send_mail,
                    ],500);
                }
//                if(!$this->sendEmailVerification($user->first_name, $user->slug,$user->email ,$uev->verification_slug)){
//                    $this->user_repo->destroy($user->slug);
//                }else{
//                    return 1;
//                };

            }
        }else{
            abort(500, 'Error in UserService');
        }
        
    }


    public function sendEmailVerification($to_name,$user_slug, $to_email,$verification_slug){
        
        $data = array("name"=>$to_name,"user_slug" => $user_slug, "verification_slug"=> $verification_slug);
        //return view('dashboard.mailables.otp');
        
        try{
            Mail::send('dashboard.mailables.otp', $data, function ($message) use ($to_email,$to_name) {
                $message->from('swep@gmail.com', 'SRA ONLINE PAYMENT');
                $message->sender('swep@gmail.com', 'SRA WEB PORTAL');
                $message->to($to_email, $to_name);

                // $message->cc('john@johndoe.com', 'John Doe');
                // $message->bcc('john@johndoe.com', 'John Doe');

                // $message->replyTo('john@johndoe.com', 'John Doe');

                $message->subject('Email Verification');

                $message->priority(3);

                // $message->attach('pathToFile');
            });
            return 1;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function sendEmailAfterTransaction($to_name,$user_slug, $to_email, $transaction){
        $data = array("name"=>$to_name,"user_slug" => $user_slug, "transaction" => $transaction);
        //return view('dashboard.mailables.otp');

        try{
            Mail::send('dashboard.mailables.mailAfterTransaction', $data, function ($message) use ($to_email,$to_name) {
                $message->from('swep@gmail.com', 'SRA ONLINE PAYMENT SYSTEM');
                $message->sender('swep@gmail.com', 'SRA ONLINE PAYMENT SYSTEM');
                $message->to($to_email, $to_name);

                // $message->cc('john@johndoe.com', 'John Doe');
                // $message->bcc('john@johndoe.com', 'John Doe');

                // $message->replyTo('john@johndoe.com', 'John Doe');

                $message->subject('Successful Transaction');

                $message->priority(3);

                // $message->attach('pathToFile');
            });
            return 1;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function sendEmailAfterApproval(){
        return 1;
    }

    public function sendEmailIncompleteTransaction(){
        return 1;
    }

    public function show($slug){

    }

    public function edit($slug){

    }

    public function update($request, $slug){

    }

//    public function destroy($slug){
//
//        $user = User::query()->where('slug', '=', $slug)->first();
//
//        $user->delete();
//
//        return $user;
//
//    }

    public function destroy($slug){

        $user = $this->findBySlug($slug);
        $user->delete();
        return $user;

    }
    public function findBySlug($slug){
        $user = $this->user
            ->select('*', DB::raw('CONCAT(first_name, " ", last_name) AS fullname'))
            ->where('slug','=' ,$slug)
            ->first();
        return $user;
    }

    public function verifyEmail($request){
        return $this->user_repo->verifyEmail($request);
    }



    public function new_slug(){

        $slug = rand(100000000,999999999);

        $validator = Validator::make(['slug'=> $slug], 
                [
                    'slug' => 'required|unique:users,slug',
                ]
            );

        if ($validator->fails()) {
            return 0;
        }

        return $slug;
    }






}