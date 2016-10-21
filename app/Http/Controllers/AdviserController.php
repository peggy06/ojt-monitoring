<?php

namespace App\Http\Controllers;

use App\Department;
use App\Log;
use App\Signature;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;

class AdviserController extends Controller
{
    public function __construct(User $user, Log $log, Department $department, Signature $signature){
        $this->users = $user;
        $this->log = $log;
        $this->department = $department;
        $this->signatures = $signature;
    }
    public function index(){
        if(session()->has('userLogin')){
            $page_title = 'Dashboard';
            $logs = $this->log;
            $signature = $this->signatures;
            $users = $this->users;
            return view('frontend.users.advisers.index', compact('users', 'signature', 'logs', 'page_title'));
        }else{
            return redirect()->route('index');
        }
    }

    public function logout(){
        $this->users->where('id', auth()->user()->id)->update(['isOnline' => '0']);
        $this->log->create([
            'user_id'   => auth()->user()->id,
            'activity'  => "Logout",
            'role'      => auth()->user()->role
        ]);
        session()->forget(['userLogin']);
        auth()->logout();
        return redirect()->back();
    }

    public function showStudents(){
        if(session()->has('userLogin')) {
            $page_title = 'My Students';
            $department = $this->department;
            $users = $this->users;
            return view('frontend.users.advisers.students', compact('users', 'department', 'page_title'));
        }else {
            return redirect()->route('index');
        }
    }

    public function signature(){
        if(session()->has('userLogin')) {
            $page_title = 'My Signature';
            $users = $this->users;
            $current_user = $this->users->find(auth()->user()->id);
            return view('frontend.users.advisers.signature', compact('current_user', 'users', 'page_title'));
        }else {
            return redirect()->route('index');
        }
    }

    public function generateSignature(Request $request){
        $count = $request->input('count');

        for($count;$count>0;$count--){
            $signature = [
                'user_id'   => auth()->user()->id,
                'signature' => strtoupper(Str::random(6)),
                'role'      => '3'
            ];
            try {
                $this->signatures->create($signature);
            }catch (Exception $e) {
                //some codes here
            }
        }

        try {
            $this->log->create([
                'user_id'   => auth()->user()->id,
                'activity'  => "Generate signature(x".$request->input('count').")",
                'role'      => auth()->user()->role
            ]);
        }catch (Exception $e) {
            //some codes here
        }

        return redirect()->back();
    }

    public function showLogs(){
        if(session()->has('userLogin')) {
            $deletedLogs = false;
            $users = $this->users;
            $logs = $this->log;
            return view('frontend.users.advisers.logs', compact('logs', 'users', 'deletedLogs'));
        }else {
            return redirect()->route('index');
        }
    }


    public function deletedLogs(){
        if(session()->has('userLogin')) {
            session(['deletedLogs' => 'show deleted logs']);
            return redirect()->back();
        }else{
            return redirect()->route('index');
        }
    }

    public function activeLogs(){
        if(session()->has('userLogin')) {
            session()->forget('deletedLogs');
            return redirect()->back();
        }else {
            return redirect()->route('index');
        }
    }

    public function resetLogs(){
        if(session()->has('userLogin')) {
            $this->log->where('deleted', '0')->update(['deleted' => '1']);
            return redirect()->back();
        }else{
            return redirect()->route('index');
        }
    }

    public function restoreLogs(){
        if(session()->has('userLogin')) {
            $this->log->where('deleted', '1')->update(['deleted' => '0']);
            return redirect()->back();
        }else{
            return redirect()->route('index');
        }
    }

    public function profile(){
        if(session()->has('userLogin')) {
            $users = $this->users;
            return view('frontend.users.advisers.profile', compact('users'));
        }else {
            return redirect()->route('index');
        }
    }

    public function changeDP(ProfilePictureRequest $request){
        $image_name = '/pictures/' . $request->file('image')->getClientOriginalName();
        $user = $this->profile->where(['user_id' => auth()->user()->id])->update(['picture' => $image_name]);

        if ($user) {
            $this->log->create([
                'user_id'   => auth()->user()->id,
                'role'      => auth()->user()->role,
                'activity'  => 'Update profile picture'
            ]);

            $request->file('image')->move(public_path() . '/pictures/', $image_name);
        }

        return redirect()->back();
    }

    public function setEmail(){
        if(session()->has('userLogin')) {
            $users = $this->users;
            return view('frontend.users.advisers.editEmail', compact('users'));
        }else {
            return redirect()->route('index');
        }
    }

    public function setPassword(){
        if(session()->has('userLogin')) {
            $users = $this->users;
            return view('frontend.users.advisers.editPass', compact('users'));
        }else {
            return redirect()->route('index');
        }
    }

    public function updateEmail(Request $request){
        if($request->input('email') == $request->input('confirmEmail')){
            if(password_verify($request->input('password'),auth()->user()->password)){
                try{
                    $email_updated = $this->users->find(auth()->user()->id)->update(['email' => $request->input('email')]);

                    if($email_updated){
                        try{
                            $this->log->create([
                                'user_id'   => auth()->user()->id,
                                'role'      => auth()->user()->role,
                                'activity'  => "Change email to ".$request->input('email'),
                            ]);

                            session()->flash('success', "Email has been changed.");
                            return redirect(route('adviserProfile'));
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
            if(password_verify($request->input('currPassword'),auth()->user()->password)){
                try{
                    $password_update = $this->users->find(auth()->user()->id)->update(['password' => bcrypt($request->input('newPassword'))]);

                    if($password_update){
                        try{
                            $this->log->create([
                                'user_id'   => auth()->user()->id,
                                'role'      => auth()->user()->role,
                                'activity'  => "Change password",
                            ]);

                            session()->flash('success', "Password has been changed.");
                            return redirect(route('adviserProfile'));

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

}
