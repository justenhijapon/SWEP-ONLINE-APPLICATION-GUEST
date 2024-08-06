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
                    $button = '<div class="btn-group">
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm view_btn" data-toggle="modal" data-target="#view_modal" title="Edit" data-placement="top">
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

    public function storePreRegistration(Request $request)
    {
        $preReg = new PreRegistrationModel();
        $preReg->slug = $this->new_slug();
        $preReg->username = $request->username;
        $preReg->password = $request->password;
        $preReg->last_name = $request->lastName;
        $preReg->first_name = $request->firstName;
        $preReg->middle_name = $request->middleName;
        $preReg->gender = $request->gender;
        $preReg->phone = $request->phoneNumber;
        $preReg->email = $request->email;
        $preReg->birthday = $request->birthday;
        $preReg->street = $request->street;
        $preReg->barangay = $request->barangay;
        $preReg->city = $request->city;
        $preReg->business_name = $request->businessName;
        $preReg->business_tin = $request->businessTin;
        $preReg->business_phone = $request->businessPhone;
        $preReg->position = $request->position;
        $preReg->business_street = $request->businessStreet;
        $preReg->business_barangay = $request->businessBarangay;
        $preReg->business_city = $request->businessCity;
        $preReg->is_verified = false;
        $preReg->created_at = Carbon::now();
        $preReg->updated_at = Carbon::now();
        $preReg->save();
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
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
    }
}