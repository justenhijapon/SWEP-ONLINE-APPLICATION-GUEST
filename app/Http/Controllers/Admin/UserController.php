<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Swep\Services\User\UserService;
use App\Swep\Services\Admin\MenuService;
use DataTables;
use Hash;
use Validator;

class UserController extends Controller
{
    protected $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = request();
            return DataTables::of($this->user_service->fetchTable($data))
                ->addColumn('action', function ($data) {
                    $destroy_route = "'" . route("admin.users.destroy", "slug") . "'";
                    $slug = "'" . $data->slug . "'";
                    $statusLabel = $data->is_active ? 'Activated' : 'Deactivated';
                    $btnClass = $data->is_active ? 'btn-success' : 'btn-danger';
                    return '<div class="btn-group">

                            <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_user_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                            </button>
                            
                           <div class="btn-group btn-group-sm">
                                <button type="button" class="btn '.$btnClass.' dropdown-toggle w-auto status-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="status-label">'.$statusLabel.'</span> 
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="update-status" data-user-slug="'.$data->slug.'" data-status="1"><small>Activate</small></a></li>
                                    <li><a href="#" class="update-status" data-user-slug="'.$data->slug.'" data-status="0"><small>Deactivate</small></a></li>
                                </ul>
                            </div>
                          
                        </div>';
                })

                ->editColumn('is_active', function ($data) {
                    return $data->is_active == 1
                        ? '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>'
                        : '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                })
                ->editColumn('is_verified', function ($data) {
                    return $data->is_verified == 1
                        ? '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>'
                        : '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                })
                ->editColumn('icon', function ($data) {
                    return '<center><span><i class="fa ' . $data->icon . '"></i></span></center>';
                })
                ->editColumn('full_name', function ($data) {
                    return $data->last_name . ', ' . $data->first_name;
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

                ->editColumn('last_activity', function ($data) {
                    if ($data->is_online) {
                        return '<span class="badge label-success">ONLINE</span>';
                    } else {
                        $lastActivity = $data->last_activity
                            ? Carbon::parse($data->last_activity)->diffForHumans()
                            : 'Unknown';
                        return '<span class="badge label-default">Active <br> <strong>' . $lastActivity . '</strong></span>';
                    }
                })
                ->rawColumns(['is_online', 'is_active', 'is_verified', 'icon', 'action'])
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }

        return view('admin.user.index');
    }



    public function create()
    {
        //
    }

    public function new_slug()
    {

        $slug = rand(10000000, 99999999);

        $validator = Validator::make(['slug' => $slug],
            [
                'slug' => 'required|unique:users,slug',
            ]
        );

        if ($validator->fails()) {
            return 0;
        }

        return $slug;
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->slug = $this->new_slug();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->last_name = $request->lastName;
        $user->first_name = $request->firstName;
        $user->middle_name = $request->middleName;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->street = $request->street;
        $user->barangay = $request->barangay;
        $user->city = $request->city;
        $user->business_name = $request->businessName;
        $user->business_tin = $request->businessTin;
        $user->business_phone = $request->businessPhone;
        $user->position = $request->position;
        $user->business_street = $request->business_street;
        $user->business_barangay = $request->business_barangay;
        $user->business_city = $request->business_city;
        $user->is_active = true;
        $user->is_verified = true;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($slug)
    {

        $user = User::query()->findOrFail($slug);
        if ($user->delete()){
            return(1);
        }

    }


    public function updateStatus($slug, Request $request)
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found!'], 404);
        }

        $user->is_active = ($request->active == 1) ? 1 : 0;
        $user->is_online = false;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'slug' => $user->slug,
            'status' => $user->is_active
        ]);
    }
}
