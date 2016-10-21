<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Department;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfilePictureRequest;
use App\Log;
use App\Profile;
use App\Signature;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //

    public function __construct(User $user, Signature $signature, Log $log, Department $department, Profile $profile){
        $this->users = $user;
        $this->signatures = $signature;
        $this->log = $log;
        $this->department = $department;
        $this->profile = $profile;
    }

    public function index(){
        return view('backend.admin.index');
    }

    public function dashboard(){
        $page_title = "Dashboard";
        $logs = $this->log;
        $users = $this->users;
        $signature = $this->signatures;
        return view('backend.admin.dashboard', compact('page_title', 'users', 'signature', 'logs'));
    }


    public function signature(){
        $users = $this->users;
        $current_user = $this->users->find(auth('admin')->user()->id);
        return view('backend.admin.signature', compact('current_user', 'users'));
    }


    public function showStudents(){
        $users = $this->users;
        return view('backend.admin.students', compact('users'));
    }


    public function showAdvisers(){
        $department = $this->department;
        $profile = $this->profile;
        $users = $this->users;
        return view('backend.admin.adviser', compact('users', 'profile', 'department'));
    }

    public function showLogs(){
        $deletedLogs = false;
        $users = $this->users;
        $logs = $this->log;
        return view('backend.admin.logs',compact('logs', 'users', 'deletedLogs'));
    }


    public function profile(){
        $users = $this->users;
        return view('backend.admin.profile', compact('users'));
    }


    public function showDepartments(){
        $department = $this->department;
        $users = $this->users;
        return view('backend.admin.departments',compact('users', 'department'));
    }


    public function login(LoginRequest $request){
        $login_credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];

        try{
            if (auth('admin')->attempt($login_credentials)) {
                if (auth('admin')->user()->role == 1){
                    try {
                        $this->users->where('id', auth('admin')->user()->id)->update(['isOnline' => '1']);

                        $this->log->create([
                            'user_id'   => auth('admin')->user()->id,
                            'activity'  => "Login",
                            'role'      => auth('admin')->user()->role
                        ]);
                    }catch (Exception $e) {
                        session()->flash('failed', "Can't record activity");
                        return redirect()->back();
                    }

                    return redirect(route('dashboard'));
                }else {
                    session()->flash('failed', "You are not allowed here!");
                    return redirect()->back();
                }
            }else {
                session()->flash('failed', "Username/Password did not match.");
                return redirect()->back();
            }
        }catch (Exception $e){
            session()->flash('failed', "SQL Server is down! Contact your SQL Service Provider about this issue.".$e->getMessage());
            return redirect()->back();
        }
    }

    public function logout(){
        try {
            $this->log->create([
                'user_id'   => auth('admin')->user()->id,
                'activity'  => "Logout",
                'role'      => auth('admin')->user()->role
            ]);

            auth('admin')->logout();
        }catch (Exception $e) {
            session()->flash('failed', "Can't record activity");
            return redirect()->back();
        }

        return redirect()->back();
    }


    public function generateSignature(Request $request){
        $count = $request->input('count');

        for($count;$count>0;$count--){
            $signature = [
                'user_id'   => auth('admin')->user()->id,
                'signature' => strtoupper(Str::random(6)),
                'role'      => '2'
            ];
            try {
                $this->signatures->create($signature);
            }catch (Exception $e) {
                //some codes here
            }
        }


        try {
            $this->log->create([
                'user_id'   => auth('admin')->user()->id,
                'activity'  => "Generate signature(x".$request->input('count').")",
                'role'      => auth('admin')->user()->role
            ]);
        }catch (Exception $e) {
            //some codes here
        }

        return redirect()->back();
    }


    public function deletedLogs(){
        session(['deletedLogs' => 'show deleted logs']);
        return redirect()->back();
    }

    public function activeLogs(){
        session()->forget('deletedLogs');
        return redirect()->back();
    }

    public function resetLogs(){
        $this->log->where('deleted', '0')->update(['deleted' => '1']);
        return redirect()->back();
    }

    public function restoreLogs(){
        $this->log->where('deleted', '1')->update(['deleted' => '0']);
        return redirect()->back();
    }

    public function chatRefresh(){
        return redirect('admin/dashboard#chat');
    }


    public function changeDP(ProfilePictureRequest $request){
        $image_name = '/pictures/' . $request->file('image')->getClientOriginalName();
        $user = $this->profile->where(['user_id' => auth('admin')->user()->id])->update(['picture' => $image_name]);

        if ($user) {
            $this->log->create([
                'user_id'   => auth('admin')->user()->id,
                'role'      => auth('admin')->user()->role,
                'activity'  => 'Update profile picture'
            ]);

            $request->file('image')->move(public_path() . '/pictures/', $image_name);
        }

        return redirect()->back();
    }

    public function setEmail(){
        $users = $this->users;
        return view('backend.admin.editEmail', compact('users'));
    }

    public function setPassword(){
        $users = $this->users;
        return view('backend.admin.editPass', compact('users'));
    }

    public function updateEmail(Request $request){
        if($request->input('email') == $request->input('confirmEmail')){
            if(password_verify($request->input('password'),auth('admin')->user()->password)){
                try{
                    $email_updated = $this->users->find(auth('admin')->user()->id)->update(['email' => $request->input('email')]);

                    if($email_updated){
                        try{
                            $this->log->create([
                                'user_id'   => auth('admin')->user()->id,
                                'role'      => auth('admin')->user()->role,
                                'activity'  => "Change email to ".$request->input('email'),
                            ]);

                            session()->flash('success', "Email has been changed.");
                            return redirect(route('profile'));
                        }catch (Exception $e){
                            session()->flash('failed', "Can't record activity");
                            return redirect()->back();
                        }
                    }
                }catch (Exception $e){
                    session()->flash('failed', "Can't update email");
                    return redirect()->back();
                }
            }else{
                session()->flash('failed', "Incorrect Password");
                return redirect()->back();
            }
        }else{
            session()->flash('failed', "Email did not match");
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request){
        if($request->input('newPassword') == $request->input('confPassword')){
            if(password_verify($request->input('currPassword'),auth('admin')->user()->password)){
                try{
                    $password_update = $this->users->find(auth('admin')->user()->id)->update(['password' => bcrypt($request->input('newPassword'))]);

                    if($password_update){
                        try{
                            $this->log->create([
                                'user_id'   => auth('admin')->user()->id,
                                'role'      => auth('admin')->user()->role,
                                'activity'  => "Change password",
                            ]);

                            session()->flash('success', "Password has been changed.");
                            return redirect(route('profile'));
                        }catch (Exception $e){
                            session()->flash('failed', "Can't record activity");
                            return redirect()->back();
                        }
                    }
                }catch (Exception $e){
                    session()->flash('failed', "Can't update passsword");
                    return redirect()->back();
                }
            }else{
                session()->flash('failed', "Incorrect Password");
                return redirect()->back();
            }
        }else{
            session()->flash('failed', "New Password did not match");
            return redirect()->back();
        }
    }

    public function addDepartment(Request $request){
        try{
            $new_department = $this->department->create([
                'name'      => ucwords($request->input('deptName')),
                'prefix'    => strtoupper($request->input('deptPrefix'))
            ]);
            if($new_department){
                try{
                    $this->log->create([
                        'user_id'   => auth('admin')->user()->id,
                        'role'      => auth('admin')->user()->role,
                        'activity'  => 'Add '.$request->input('deptPrefix').' Department'
                    ]);
                    return redirect()->back();
                }catch (Exception $e){
                    session()->flash('failed', "Can't record activity");
                    return redirect()->back();
                }
            }
        }catch (Exception $e){
            session()->flash('failed', "Can't add new department");
            return redirect()->back();
        }
    }
}