<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\PreRegistrationFormRequest;
use App\Models\User;
use App\Models\User\PreRegistrationModel;
use App\Swep\Repositories\Admin\PreRegistrationRepository;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Hash;
use Validator;

class PreRegistrationController extends Controller
{
    protected $preRegistrationRepo;
    public function __construct(PreRegistrationRepository $preRegistrationRepo)
    {
        $this->preRegistrationRepo = $preRegistrationRepo;
    }

    public function index(){
        if(request()->ajax())
        {
            $data = request();
            return DataTables::of($this->preRegistrationRepo->fetchTable($data))

                ->addColumn('action', function($data){
                    $button = '<div class="btn-group" role="group" aria-label="Basic example" style="height: 45%">
                                <button type="button" data="'.$data->slug.'" class="btn btn-success btn-sm view_btn" data-toggle="modal" data-target="#view_modal">
                                    APPROVAL
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $button;
                })

                ->editColumn('last_name', function($data) {
                    $fullname= $data->first_name . ' ' . ($data->middle_name ? strtoupper(substr($data->middle_name, 0, 1)) . '. ' : '') . $data->last_name;
                    return '<p style="" class="no-margin">'.$fullname.' </p>';
                })
                ->editColumn('business_name', function($data) {
                    $full_address = $data->business_street . ', ' . $data->business_barangay . ', ' . $data->business_city;
                    return '<p style="" class="no-margin">'.$data->business_name.'</p>
                    <p style="font-size: smaller" class="no-margin">'.$full_address.'</p>';
                })

                ->editColumn('email', function($data) {
                    return '<p style="color: #15c;" class="no-margin"><u>'.$data->email.'</u> </p>
                            <p style="" class="no-margin">'.$data->phone.' </p>';
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('admin.preRegistration.index');
    }

    private function hyphenate($str) {
        return implode("-", str_split($str, 3));
    }

    public function new_slug(){

        $slug = rand(10000000,99999999);

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

    public function storePreRegistration(PreRegistrationFormRequest $request)
    {
        $appData = new User\ImportedCommodities();
        $preReg = new PreRegistrationModel();
        $ipAddress = $request->ip();
        $preReg->slug = $this->new_slug();
        $preReg->username = $request->username;
        $preReg->password = $request->password;
        $preReg->last_name = $request->last_name;
        $preReg->first_name = $request->first_name;
        $preReg->middle_name = $request->middle_name;
        $preReg->gender = $request->gender;
        $preReg->phone = $request->phone;
        $preReg->email = $request->email;
        $preReg->birthday = $request->birthday;
        $preReg->street = $request->street;
        $preReg->barangay = $request->barangay;
        $preReg->city = $request->city;
        $preReg->business_name = $request->business_name;
        $preReg->business_tin = $request->business_tin;
        $preReg->business_phone = $request->business_phone;
        $preReg->position = $request->position;
        $preReg->business_street = $request->business_street;
        $preReg->business_barangay = $request->business_barangay;
        $preReg->business_city = $request->business_city;
        $preReg->status = 'FOR APPROVAL';
        $preReg->is_verified = false;
        $preReg->created_at = Carbon::now();
        $preReg->updated_at = Carbon::now();
        $preReg->save();

        $fullname= $preReg->first_name . ' ' . ($preReg->middle_name ? strtoupper(substr($preReg->middle_name, 0, 1)) . '. ' : '') . $preReg->last_name;
        $full_address = $preReg->business_street . ', ' . $preReg->business_barangay . ', ' . $preReg->business_city;
        $appData->slug = strtoupper($this->hyphenateApp(str_shuffle(str_random(5) . rand(1000, 9999)))) . '-' . date('my');
        $appData->user_created = $preReg ->slug;
        $appData->name = $fullname;
        $appData->contact_no = $request->business_phone;
        $appData->designation = $request->position;
        $appData->company = $request->business_name;
        $appData->tin = $request->business_tin;
        $appData->address = $full_address;
        $appData->email = $request->email;
        $appData-> ip_created = $ipAddress;

        $appData->save();


    }

    public function show($id){
        $preReg = PreRegistrationModel::where('slug',$id)->first();
        return view('admin.preRegistration.view')->with(['preReg' => $preReg]);
    }

    public function approved($id){

        $preReg = PreRegistrationModel::where('slug',$id)->first();
        $user = new User();
        $user->slug = $preReg->slug;
        $user->username = $preReg->username;
        $user->password = Hash::make($preReg->password);
        $user->last_name = $preReg->last_name;
        $user->first_name = $preReg->first_name;
        $user->middle_name = $preReg->middle_name;
        $user->phone = $preReg->phone;
        $user->email = $preReg->email;
        $user->birthday = $preReg->birthday;
        $user->street = $preReg->street;
        $user->barangay = $preReg->barangay;
        $user->city = $preReg->city;
        $user->business_name = $preReg->business_name;
        $user->business_tin = $preReg->business_tin;
        $user->business_phone = $preReg->business_phone;
        $user->position = $preReg->position;
        $user->business_street = $preReg->business_street;
        $user->business_barangay = $preReg->business_barangay;
        $user->business_city = $preReg->business_city;
        $user->is_active = true;
        $user->is_verified = true;
        $preReg->status = 'APPROVED';
        $preReg->is_verified = true;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();

        $user->save();
        $preReg->save();


    }

    public function destroy($slug){
        $preReg = PreRegistrationModel::where('slug', '=', $slug)->first();
        $preReg->destroy();
    }

    private function hyphenateApp(string $str)
    {
        return implode("-", str_split($str, 3));
    }
}