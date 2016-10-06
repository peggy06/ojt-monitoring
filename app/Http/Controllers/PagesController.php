<?php

namespace App\Http\Controllers;

use App\Signature;
use App\User;
use App\Verification;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;
use Jcf\Geocode\Geocode;
use Mockery\CountValidator\Exception;

class PagesController extends Controller
{

    public function __construct(Signature $signature, User $user, Verification $verification){
        $this->user = $user;
        $this->signature = $signature;
        $this->verification = $verification;
    }

    public function index(){
        return view('frontend.users.index');
    }

    public function showLoginForm(){
        return view('frontend.users.login');
    }

    public function login(Request $request){
        $login_credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];

        if(auth()->attempt($login_credentials)){
            if (auth()->user()->role != 1){
                return "login temporary";
            }else {
                session()->flash('failed', 'Hi Admin! Please use appropriate login form for you, thank you.');
                return redirect()->back();
            }
        }else {
            session()->flash('failed', 'Email/Password did not match.');
            return redirect()->back();
        }
    }

    public function showRegistrationForm(){
        return view('frontend.users.register');
    }

    public function register(Request $request){
        $signature_exist = $this->signature->where('signature', $request->input('signature'))->first();

        if ($signature_exist && $signature_exist->used_by == null){
            $user = [
                'firstname' => $request->input('firstname'),
                'lastname'  => $request->input('lastname'),
                'name'      => $request->input('firstname')." ".$request->input('lastname'),
                'email'     => $request->input('email'),
                'role'      => $signature_exist->role,
            ];

            $new_user = $this->user->create($user);

            if ($new_user){
                $this->$signature_exist = $this->signature->where('signature', $request->input('signature'))->update([
                   'used_by' => $new_user->id
                ]);

                $this->verification->create([
                   'user_id'    => $new_user->id,
                   'code'       => Str::random(36),
                ]);

                return "nothing to do in here";
            }
        }
    }


    public function showConfirmation($code){
        $vCode = $this->verification->where('code', $code)->first();
        if ($vCode->used == 0){
            return "confirmation start";
        }else {
            return "invalid request";
        }
    }
}
