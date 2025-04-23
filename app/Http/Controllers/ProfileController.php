<?php

namespace App\Http\Controllers;

use Hash;
use App\Core\Interfaces\ProfileInterface;
use App\Http\Requests\Profile\ProfileUpdateAccountUsernameRequest;
use App\Http\Requests\Profile\ProfileUpdateAccountPasswordRequest;
use App\Http\Requests\Profile\ProfileUpdateAccountColorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller{


    protected $profile_repo;


    public function __construct(ProfileInterface $profile_repo){

        $this->profile_repo = $profile_repo;
        parent::__construct();

    }




	public function details(){
        return view('dashboard.profile.details');
    }




    public function updateAccountUsername(ProfileUpdateAccountUsernameRequest $request, $slug){

        $user = $this->profile_repo->updateUsername($request, $slug);
        $this->session->flush();
        $this->auth->logout();
        $this->event->dispatch('dashboard.profile.update_account_username', $user);
//        $this->event->fire('profile.update_account_username', $user);
        return redirect('/')->with('status', 'Username successfully updated. Please log in again.');
        
    }




    public function updateAccountPassword(ProfileUpdateAccountPasswordRequest $request, $slug){

        if(Hash::check($request->old_password, $this->auth->user()->password)){

            $user = $this->profile_repo->updatePassword($request, $slug);
            $this->session->flush();
            $this->auth->logout();
            $this->event->dispatch('dashboard.profile.update_account_password', $user);
            return redirect('/');

        }

        $this->session->flash('PROFILE_OLD_PASSWORD_FAIL', 'The old password you provided does not match.');
        return redirect()->back();
        
    }


    

    public function updateAccountColor(ProfileUpdateAccountColorRequest $request, $slug){

        $user = $this->profile_repo->updateColor($request, $slug);
        $this->event->fire('profile.update_account_color', $user);
        return redirect()->back();
        
    }

    private function handleProfileUpload(Request $request, $fileInputName, $slug)
    {
        if ($request->hasFile($fileInputName)) {
            $file = $request->file($fileInputName);
            $folderPath = 'user_profiles/' . $slug; // Organized by slug or user ID
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store file in the public disk so it can be accessed by asset('storage/...')
            return $file->storeAs($folderPath, $filename, 'local');
        }

        return null;
    }

//    public function upload(Request $request)
//    {
//        $request->validate([
////            'profile_picture' => 'required|image|max:2048',
////            'slug' => 'required|string', // to organize storage folder
//        ]);
//
//        $user = auth()->user();
//
//        // Save the file to your custom local disk
//        $folderPath = 'user_profiles/' . $request->slug;
//        $filename = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
//        $path = $request->file('profile_picture')->storeAs($folderPath, $filename, 'local');
//
//        // Delete previous image if needed
//        if ($user->user_profile_path && Storage::disk('local')->exists($user->user_profile_path)) {
//            Storage::disk('local')->delete($user->user_profile_path);
//        }
//
//        // Save new path in the database
//        $user->user_profile_path = $path;
//        $user->save();
//
//        return response()->json(['success' => true, 'message' => 'Profile picture uploaded successfully.']);
//    }

    public function upload(Request $request)
    {
        $request->validate([
//            'user_profile_path' => 'required|image|max:2048',
        ]);

        $user = auth()->user();

        $path = $this->handleProfileUpload($request, 'profile_picture', $user->slug ?? $user->id);

        if ($path) {
            // Delete old picture if it's not default and exists
            if ($user->user_profile_path && Storage::disk('local')->exists($user->user_profile_path)) {
                Storage::disk('local')->delete($user->user_profile_path);
            }

            $user->user_profile_path = $path;
            $user->save();
        }

        return back()->with('success', 'Profile picture updated!');
    }


//    public function upload(Request $request)
//    {
//        $request->validate([
//            'user_profile_path' => 'required|image|max:2048', // max 2MB
//        ]);
//
//        $path = $request->file('user_profile_path')->store('user_profile_paths', 'public');
//
//        $user = auth()->user();
//
//        // Optionally delete old picture if it's not the default one
//        if ($user->user_profile_path && Storage::disk('public')->exists($user->user_profile_path)) {
//            Storage::disk('public')->delete($user->user_profile_path);
//        }
//
//        $user->user_profile_path = $path;
//        $user->save();
//
//        return back()->with('success', 'Profile picture updated!');
//    }




}
