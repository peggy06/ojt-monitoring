<?php

namespace App\Http\Controllers;

use App\Department;
use App\Log;
use App\Profile;
use App\Signature;
use App\User;
use App\Verification;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Jcf\Geocode\Geocode;
use Torann\GeoIP\GeoIP;

class PagesController extends Controller
{

    /**
     * @param Signature $signature
     * @param User $user
     * @param Verification $verification
     * @param Log $log
     * @param Department $department
     * @param Profile $profile
     */
    public function __construct(Signature $signature, User $user, Verification $verification, Log $log, Department $department, Profile $profile, GeoIPController $geoIPController){

        $this->user = $user;
        $this->signature = $signature;
        $this->verification = $verification;
        $this->log = $log;
        $this->department = $department;
        $this->profile = $profile;
        $this->geoIpController = $geoIPController;

    }

    /**
     * users (Adviser and Students) index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        if(session()->has('userLogin')){
            if(auth()->user()->role == 2){
                return redirect()->route('adviserDashboard');
            }else {
//                return redirect()->route('studentDashboard');
            }
        }else{

//            $this->geoIpController->locate($request->getClientIp());
//            echo $this->geoIpController->ip."<br>";
//            echo $this->geoIpController->longitude."<br>";
//            echo $this->geoIpController->latitude."<br>";
//            echo "nice city";
////            return view('frontend.users.index');
//
//            $response = Geocode::make()->latLng($this->geoIpController->latitude, $this->geoIpController->longitude);
//            if ($response){
//                echo $response->locationType();
//                echo $response->formattedAddress();
//            }
            echo file_get_contents('https://ipapi.co/'.$request->getClientIp().'/country/');
            $location = file_get_contents('http://freegeoip.net/json/'.$request->getClientIp());
            print_r($location);
            echo $request->getClientIp();
            echo $request->ip();
        }

    }

    /**
     * login form for users (Adviser and Student)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(){
        if(session()->has('userLogin')){
            if(auth()->user()->role == 2){
                return redirect()->route('adviserDashboard');
            }else {
//                return redirect()->route('studentDashboard');
            }
        }else {
            return view('frontend.users.login');
        }
    }

    /**
     * Show Registration Form for users (Advisers and Students)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(){
        if(session()->has('userLogin')){
            if(auth()->user()->role == 2){
                return redirect()->route('adviserDashboard');
            }else {
//                return redirect()->route('studentDashboard');
            }
        }else {
            return view('frontend.users.register');
        }
    }

    /**
     * login for students and advisers
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|string
     */
    public function login(Request $request){
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
//                    if (auth()->user()->role == 2){
//                        return redirect(route('adviserDashboard'));
//                    }else {
//                        return view('frontend.users.students.index');
//                    }

                    return redirect()->back();


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

    /**
     * registration for students and advisers
     * @param Request $request
     * @return string
     */
    public function register(Request $request){
        if(session()->has('userLogin')){
            if(auth()->user()->role == 2){
                return redirect()->route('adviserDashboard');
            }else {
//                return redirect()->route('studentDashboard');
            }
        }else{
            //test if signature exist and catch exception if not
            try {
                $signature_exist = $this->signature->where('signature', $request->input('signature'))->first();
            }catch (Exception $e) {
                session()->flash('failed', "Cant process request. <br>".$e->getMessage());
                return redirect()->back();
            }

            //check signatures availability
            if ($signature_exist && $signature_exist->used_by == null){

                //set new user data
                $user = [
                    'firstname' => $request->input('firstname'),
                    'lastname'  => $request->input('lastname'),
                    'name'      => $request->input('firstname')." ".$request->input('lastname'),
                    'email'     => $request->input('email'),
                    'role'      => $signature_exist->role,
                    'under_to'  => $signature_exist->user_id
                ];

                //set email verification data
                $code = Str::random(36);
                $data = [
                    'firstname' => $request->input('firstname'),
                    'lastname'  => $request->input('lastname'),
                    'email'     => $request->input('email'),
                    'code'      => $code,
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
                        }catch (Exception $e) {
                            session()->flash('failed', "Cant create account <br>".$e->getMessage());
                            return redirect()->back();
                        }

                        if ($new_user){
                            //update signature availability
                            $this->$signature_exist = $this->signature->where('signature', $request->input('signature'))->update(['used_by' => $new_user->id]);

                            //create profile for new user
                            $this->profile->create(['user_id' => $new_user->id]);

                            //try to store verification code to db
                            try {
                                $this->verification->create(['user_id' => $new_user->id, 'code' => $code,]);
                            }catch (Exception $e){
                                session()->flash('failed', "Cant process your request. <br>".$e->getMessage());
                                return redirect()->back();
                            }

                        }else {
                            //failed: create new user
                            session()->flash('failed', "Cant process your request.");
                            return redirect()->back();
                        }
                    }else {
                        //failed: send email
                        session()->flash('failed', "Cant send email.");
                        return redirect()->back();
                    }
                }catch (Exception $e) {
                    //failed: email exceptions
                    session()->flash('failed', "Cant send email. <br>".$e->getMessage());
                    return redirect()->back();
                }

                return "nothing to do in here! check your email to complete registration"; //TODO: change into view
            }else {
                //failed: signature not available
                session()->flash('failed', "Signature doesn't exist or has been used by other user.");
                return redirect()->back();
            }
        }
    }

    /**
     * Last step for registration
     * @param Request $request
     * @param $id
     * @return string
     */
    public function setup(Request $request, $id){
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

                        if ($user->role == 2){
                            $this->profile->where('user_id', $id)->update(['department' => $request->input('department')]);
                            $class = "OJT Adviser";
                        }elseif ($user->role == 3) {
                            $this->profile->where('user_id', $id)->update(['department' => $this->user->find($user->under_to)->profile->department]);
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



                    return "Your registration was complete <a href='".route('showLogin')."'>click here to login."; //TODO: redirect ot somewhere
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

    /**
     * Verification link for confirmation
     * @param $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showConfirmation($code){
        $departments = $this->department->where('deleted', '0')->get();
        $user = $this->user;
        $vCode = $this->verification->where('code', $code)->first();
        if ($vCode->used == 0){
            return view('frontend.users.confirmation', compact('vCode', 'user', 'departments'));
        }else {
            return "invalid request";
        }
    }
}
