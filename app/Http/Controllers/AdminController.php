<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\LoginRequest;
use App\Signature;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //

    public function __construct(User $user, Signature $signature){
        $this->users = $user;
        $this->signatures = $signature;
    }

    public function index(){
        return view('backend.admin.index');
    }

    public function login(LoginRequest $request){
        $login_credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];

        if (auth('admin')->attempt($login_credentials)) {
            if (auth('admin')->user()->role == 1){
                return redirect(route('dashboard'));
            }else {
                session()->flash('failed', "You are not allowed here!");
                return redirect()->back();
            }
        }else {
            session()->flash('failed', "Username/Password did not match.");
            return redirect()->back();
        }
    }

    public function logout(){
        auth('admin')->logout();
        return redirect()->back();
    }

    public function dashboard(){
        $page_title = "Dashboard";
        $users = $this->users;
        $signature = $this->signatures;
        return view('backend.admin.dashboard', compact('page_title', 'users', 'signature'));
    }

    public function signature(){
        $current_user = $this->users->find(auth('admin')->user()->id);
        return view('backend.admin.signature', compact('current_user'));
    }

    public function generateSignature(Request $request){
        $count = $request->input('count');

        for($count;$count>0;$count--){
            $signature = [
                'user_id'   => auth('admin')->user()->id,
                'signature' => Str::random(6),
                'role'      => 2
            ];

            $this->signatures->create($signature);
        }

        return redirect()->back();
    }

    public function showStudents(){
        $users = $this->users->where('role', '3')->get();
        return view('backend.admin.students', compact('users'));

    }
}
