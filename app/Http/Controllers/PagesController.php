<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\SetupRequest;
use App\Log;
use App\Permission;
use App\Profile;
use App\Signature;
use App\User;
use App\Verification;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function __construct(User $user, Permission $permission, Signature $signature, Verification $verification, Log $log, Profile $profile, Course $course){
        $this->user = $user;
        $this->permission = $permission;
        $this->signature = $signature;
        $this->verification = $verification;
        $this->log = $log;
        $this->profile = $profile;
        $this->course = $course;

        session_start();
    }

    public function index(){
        try{
            $hasAdmin = $this->user->where(['id' => 1])->count();

            if($hasAdmin){
                if(!auth()->guest()){
                    if(auth()->user()->role == 4 and auth()->user()->password != null and auth()->user()->confirmed == 1){
                        return redirect()->route('adviserDashboard');
                    }else{

                    }
                }else{
                    return view('frontend.index');
                }
            }else{
                return view('errors.not_yet_available');
            }
        }catch (Exception $e){
            session()->flash('failed', $e->getMessage());
            echo $e;
        }
    }

    public function register(RegistrationRequest $request){
        //validate contact
        $validate_contact = $request->input('contact');

        preg_match_all('/[0-9]/', $validate_contact, $number_count);
        $numeric['count'] = count($number_count[0]);

        if($numeric['count'] == 0){
            session()->flash('reg-failed', 'The contact must be a number');
            return redirect()->back();
        }else{
            //test if signature exist and catch exception if not
            try {
                $signature_exist = $this->signature->where('signature', $request->input('signature'))->first();

                //check signatures availability
                if ($signature_exist){
                    //set new user data

                    //set avatar
                    $user = [
                        'firstname' => ucfirst($request->input('firstname')),
                        'lastname'  => ucfirst($request->input('lastname')),
                        'name'      => ucwords($request->input('firstname')." ".$request->input('lastname')),
                        'email'     => $request->input('email'),
                        'role'      => $signature_exist->role,
                        'under_to'  => $signature_exist->user_id
                    ];

                    //set email verification data
                    $verification_code = Str::random(36);
                    $data = [
                        'firstname' => $request->input('firstname'),
                        'lastname'  => $request->input('lastname'),
                        'email'     => $request->input('email'),
                        'code'      => $verification_code,
                    ];

                    //try to send email, catch exception and return error message if can't
                    try {
//                TODO: Remove comment tags on email feature
//                $sent = Mail::send('mails.confirmationMail', $data, function($msg)use($data){
//                    $msg->to($data['email'], $data['firstname'].' '.$data['lastname'])->subject('Welcome to OJT Monitoring');
//                    $msg->from('ojttracker@gmail.com', 'OJT Monitoring BOTS');
//                });

                        $sent = true; //temporary: email sending features need internet connection

                        //if email sent , create incomplete or temporary user
                        if ($sent){
                            try {
                                $new_user = $this->user->create($user);

                                if ($new_user){

                                    //set avatar
                                    if($new_user->role == 4){
                                        if($request->input('gender') == 'male'){
                                            $avatar = "/images/avatar_male_adviser.png";
                                        }else{
                                            $avatar = "/images/avatar_female_adviser.png";
                                        }
                                    }elseif($new_user->role == 5){
                                        if($request->input('gender') == 'male'){
                                            $avatar = "/images/avatar_male_student.png";
                                        }else{
                                            $avatar = "/images/avatar_female_student.png";
                                        }
                                    }

                                    //create profile for new user
                                    $this->profile->create([
                                        'user_id'   => $new_user->id,
                                        'gender'    => $request->input('gender'),
                                        'contact'   => $request->input('contact'),
                                        'avatar'    => $avatar
                                    ]);

                                    //create digital signature
                                    $this->signature->create([
                                        'user_id'   => $new_user->id,
                                        'signature' => strtoupper(Str::random(12)),
                                        'role'      => '5'
                                    ]);

                                    //try to store verification code to db
                                    try {
                                        $this->verification->create(['user_id' => $new_user->id, 'code' => $verification_code,]);
                                    }catch (Exception $e){
                                        session()->flash('reg-failed', "Cant process your request. <br>".$e->getMessage());
                                        return redirect()->back();
                                    }

                                    //send request
                                    try{
                                        $this->permission->create([
                                            'user_id'   => $new_user->id,
                                            'request'   => "Wants to be an OJT Adviser under your supervision.",
                                            'to'        => $signature_exist->user_id,
                                            'new'       => 1
                                        ]);
                                    }catch (Exception $e){
                                        session()->flash('reg-failed', "cant send request");
                                        return redirect()->back();
                                    }
                                }else {
                                    //failed: create new user
                                    session()->flash('reg-failed', "Cant process your request.");
                                    return redirect()->back();
                                }
                            }catch (Exception $e) {
                                session()->flash('reg-failed', "Cant create account. <br> DUPLICATE ENTRY!");
                                return redirect()->back();
                            }
                        }else {
                            //failed: send email
                            session()->flash('reg-failed', "Cant send email.");
                            return redirect()->back();
                        }
                    }catch (Exception $e) {
                        //failed: email exceptions
                        session()->flash('reg-failed', "Cant send email. <br>".$e->getMessage());
                        return redirect()->back();
                    }

                    $enc = encrypt($verification_code); //for deployment remove $enc
                    return redirect()->route('userDone', $enc);
                }else {
                    //failed: signature not available
                    session()->flash('reg-failed', "Signature doesn't exist or has been used by other user.");
                    return redirect()->back();
                }
            }catch (Exception $e) {
                session()->flash('reg-failed', "Cant process request. <br>".$e->getMessage());
                return redirect()->back();
            }
        }
    }

    public function done($code){
        if(session()->has('userLogin')){
            if(auth()->user()->role == 4){
                return redirect()->route('adviserDashboard');
            }
        }else{
            return view('frontend.done', compact('code'));
        }
    }

    public function confirmation($code){
        if(session()->has('userLogin')){
            if(auth()->user()->role == 4){
                return redirect()->route('adviserDashboard');
            }
        }else {
            $code = decrypt($code); //decrypt link code

            try {
                $validate_link = $this->verification->where(['code' => $code, 'used' => 0])->first();
            } catch (Exception $e) {
                return view('errors.already_confirmed');
            }

            if ($validate_link) {
                $courses = $this->course->where(['available' => 1])->get();
                $user = $this->user->where('id', $validate_link->user_id)->first();
                return view('frontend.confirmation', compact('user', 'courses'));
            } else {
                return view('errors.already_confirmed');
            }
        }
    }

    public function setup(SetupRequest $request, $id){
        if($request->input('password') == $request->input('confirm')){
            $credentials = [
                'password' => bcrypt($request->input('password')),
                'confirmed' => '1'
            ];

            try {
                $new_user = $this->user->find($id)->update($credentials);

                if($new_user){
                    $validity = ['used' => '1'];

                    try{
                        $user = $this->user->where('id', $id)->first();
                        $class = null;

                        if ($user->role == 4){
                            $this->profile->where('user_id', $id)->update(['course' => $request->input('department')]);
                            $class = "OJT Adviser";
                        }elseif ($user->role == 5) {
                            $this->profile->where('user_id', $id)->update(['course' => $this->user->find($user->under_to)->profile->course]);
                            $class = "OJT Student";
                        }else {
                            $class = "UNKNOWN";
                        }

                        $this->verification->where('user_id', $id)->update($validity);

                        try {
                            $this->log->create([
                                'user_id'   => $id,
                                'activity'  => "Register as ".$class,
                                'role'      =>  $user->role
                            ]);
                        }catch (Exception $e) {
                            session()->flash('failed', "Can't record activity");
                            return redirect()->back();
                        }

                    }catch (Exception $e) {
                        session()->flash('failed', "Some Problem occur: ".$e->getMessage());
                        return redirect()->back();
                    }



                    return redirect()->route('userConfirmed');
                }
            }catch (Exception $e) {
                session()->flash('failed', "Failed to setup password <br> BOTS says: ".$e->getMessage());
                return redirect()->back();
            }
        }else{
            session()->flash('failed', "Password did not match");
            return redirect()->back();
        }
    }

    public function confirmed(){
        if(session()->has('userLogin')){
            if(auth()->user()->role == 4){
                return redirect()->route('adviserDashboard');
            }
        }else {
            return view('frontend.confirm');
        }
    }

    public function login(LoginRequest $request){
        $login_credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];

        try {
            if(auth()->attempt($login_credentials)){
                if (auth()->user()->role != 1){

                    //update online status of user and create log about it
                    try {
                        //update online status of user
                        $this->user->where('id', auth()->user()->id)->update(['isOnline' => '1']);

                        //record activity to log
                        $this->log->create([
                            'user_id'   => auth()->user()->id,
                            'activity'  => "Login",
                            'role'      => auth()->user()->role
                        ]);

                    }catch (Exception $e) {
                        session()->flash('failed', "Can't record activity");
                        return "error".$e->getMessage();
                    }

                    //create session
                    session(['userLogin' => "Logged In"]);

                    //filter user if adviser or students
                    if (auth()->user()->role == 4){
                        return redirect()->route('adviserDashboard');
                    }else {
                        return view('frontend.users.students.index');
                    }
                }else {
                    session()->flash('failed', 'Hi Admin! Please use appropriate login form for you, thank you.');
                    return redirect()->back();
                }
            }else {
                session()->flash('failed', 'Email/Password did not match.');
                return redirect()->back();
            }
        }catch (Exception $e) {
            session()->flash('failed', "Failed to login. <br>".$e->getMessage());
            return redirect()->back();
        }
    }
}
