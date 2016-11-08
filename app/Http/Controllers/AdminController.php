<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Company;
use App\Course;
use App\Hour;
use App\Http\Requests\HoursRequest;
use App\Http\Requests\InstallationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\SectionRequest;
use App\Key;
use App\Log;
use App\Message;
use App\Notification;
use App\Permission;
use App\Profile;
use App\Section;
use App\Signature;
use App\User;
use App\Verification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Vsmoraes\Pdf\Pdf;

class AdminController extends Controller
{
    public function __construct(User $user, Profile $profile, Verification $verification, Key $key, Log $log, Signature $signature, Course $course, Section $section, Company $company, PDF $pdf, Hour $hour, Permission $permission, Notification $notification, Message $message, Chat $chat){
        $this->user = $user;
        $this->profile = $profile;
        $this->verification = $verification;
        $this->key = $key;
        $this->logs = $log;
        $this->signature = $signature;
        $this->course = $course;
        $this->section = $section;
        $this->company = $company;
        $this->hour = $hour;
        $this->permissions = $permission;
        $this->notifications = $notification;
        $this->messages = $message;
        $this->chat = $chat;
        $this->pdf = $pdf;

        session_start();
    }

    public function index(){
        try{
            $admin_exist = $this->user->where(['role' => '1', 'deleted' => '0'])->count();
        }catch (Exception $e){
            return view('backend.oops');
        }

        if($admin_exist == 0){
            session(['account_setup' => 'Admin account for fresh app']);
            return redirect()->route('adminSetup');
        }else{
            if(session()->has('adminLogin')){
                return redirect()->route('adminDashboard');
            }else{
                $page_title = 'Admin Login';
                return view('backend.index', compact('page_title'));
            }
        }
    }

    public function setup(){
        if(session()->has('account_setup')){
            $page_title = 'Account Setup';
            return view('backend.setup', compact('page_title'));
        }else{
            return redirect()->route('adminIndex');
        }
    }

    public function install(InstallationRequest $request){

        ini_set('max_execution_time', 300);

        //contact number validation
        $validate_contact = $request->input('contact');
        preg_match_all('/[0-9]/', $validate_contact, $numbers);
        $numlen['count'] = count($numbers[0]);

        //get the number length of the contact
        if($numlen['count'] == 0 or $numlen['count'] < 10){
            session()->flash('setup-failed', 'The contact must be a number');
            return redirect()->back();
        }else{
            $contact_validated = true;
        }

        //validate app-key
        $app_key_validated = $this->key->where('app_key', $request->input('key'))->first();

        if($contact_validated ){
            if($app_key_validated){
                $admin = [
                    'firstname' => ucfirst($request->input('firstname')),
                    'lastname'  => ucfirst($request->input('lastname')),
                    'name'      => ucwords($request->input('firstname').' '.$request->input('lastname')),
                    'email'     => $request->input('email'),
                    'role'      => 1,
                    'under_to'  => 0
                ];

                //create verification link code
                $verification_code = Str::random(36);

                //set email data
                $email_data = [
                    'firstname' => ucfirst($request->input('firstname')),
                    'lastname'  => ucfirst($request->input('lastname')),
                    'email'     => $request->input('email'),
                    'code'      => $verification_code
                ];

                //send email confirmation to the user
                try{
                    $sent = Mail::send('mails.adminConfirmationMail', $email_data, function($msg)use($email_data){
                        $msg->to($email_data['email'], $email_data['firstname'].' '.$email_data['lastname'])->subject('Welcome to OJT Monitoring System');
                        $msg->from('ojttracker@gmail.com', 'OJT Monitoring System Bot');
                    });
//                    $sent = true; //temporary email sent
                }catch (Exception $e){
                    session()->flash('setup-failed', "Can't send account confirmation to your email address. Please check your network connection and try again.".$e->getMessage()));
                    return redirect()->back();
                }

                //if email sent successful, create admin account
                if($sent){
                    try{
                        $new_admin = $this->user->create($admin);
                    }catch (Exception $e){
                        session()->flash('setup-failed', "Can't create new account because".$e->getMessage);
                        return redirect()->back();
                    }

                    if($new_admin){

                        //set avatar
                        if($request->input('gender') == 'male'){
                            $avatar = "/images/avatar_male_adviser.png";
                        }else{
                            $avatar = "/images/avatar_female_adviser.png";
                        }

                        //create user profile for admin
                        try{
                            $this->profile->create([
                                'user_id'   => $new_admin->id,
                                'gender'    => $request->input('gender'),
                                'contact'   => $request->input('contact'),
                                'avatar'    => $avatar
                            ]);

                            //create digital signature
                            $this->signature->create([
                                'user_id'   => $new_admin->id,
                                'signature' => strtoupper(Str::random(12)),
                                'role'      => '4'
                            ]);

                        }catch (Exception $e){
                            session()->flash('setup-failed', "Can't create user profile because ".$e->getMessage());
                            return redirect()->back();
                        }

                        //record verification link
                        try{
                            $this->verification->create(['user_id' => $new_admin->id, 'code' => $verification_code]);
                        }catch (Exception $e){
                            session()->flash('setup-failed', "Can't create verification link because ".$e->getMessage());
                            return redirect()->back();
                        }

                        //record activity
                        try{
                            $this->logs->create([
                                'user_id'   => $new_admin->id,
                                'activity'  => $new_admin->name.' register as admin',
                                'role'      => $new_admin->role
                            ]);
                        }catch (Exception $e){

                        }

                        $enc = encrypt($verification_code);
                        session()->forget('account_setup');
                        return redirect()->route('adminDone');
                    }
                }
            }else{
                session()->flash('setup-failed', "The APP-key that you typed in is incorrect. The APP-key is provided with the package users manual");
                return redirect()->back();
            }
        }
    }

    public function done(){
        return view('backend.done');
    }

    public function confirmation($code){

        $code = decrypt($code); //decrypt link code

        try{
            $validate_link = $this->verification->where(['code' => $code, 'used' => 0])->first();
        }catch (Exception $e){
            return view('errors.already_confirmed');
        }

        if($validate_link){
            $admin = $this->user->where('id', $validate_link->user_id)->first();
            return view('backend.confirmation', compact('admin'));
        }else{
            return view('errors.already_confirmed');
        }
    }

    public function confirm(PasswordRequest $request, $id){
        if($request->input('password') == $request->input('confirm')) {
            $password = [
                'password' => bcrypt($request->input('password')),
                'confirmed' => 1
            ];

            try {
                $admin_account = $this->user->find(decrypt($id))->update($password);
            } catch (Exception $e) {
                session()->flash('failed', "Cant set password because " . $e->getMessage());
                return redirect()->back();
            }

            if ($admin_account) {
                try {
                    $this->verification->where('user_id', decrypt($id))->update(['used' => '1']);
                } catch (Exception $e) {
                    session()->flash('failed', "Some problem occur in updating verification link. Message: " . $e->getMessage());
                    return redirect()->back();
                }

                return redirect()->route('adminConfirmed');
        }
        }else{
            session()->flash('failed', "Password did not match!");
            return redirect()->back();
        }
    }

    public function confirmed(){
        return view('backend.confirm');
    }

    public function login(LoginRequest $request){
        $credentials = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ];

        try{
            if(auth('admin')->attempt($credentials)){
                if(auth('admin')->user()->role == 1){
                    try{
                        $this->user->find(auth('admin')->user()->id)->update(['isOnline' => '1']);

                        $this->logs->create([
                            'user_id'   => auth('admin')->user()->id,
                            'activity'  => "Login",
                            'role'      => auth('admin')->user()->role
                        ]);
                    }catch (Exception $e){
                        session()->flash('failed', "Can't record log record because ".$e->getMessage());
                        return redirect()->back();
                    }

                    session(['adminLogin' => "admin is online"]);
                    return redirect()->route('adminDashboard');
                }
            }else{
                session()->flash('failed', "Email and Password did not match");
                return redirect()->back();
            }
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function dashboard(){
        if(!auth('admin')->guest()){
            if($this->hour->find(1)->first()->hours != 0){
                $page_title = 'Dashboard';
                $users = $this->user;
                $logs = $this->logs;
                $signature = $this->signature;
                $permissions = $this->permissions;
                return view('backend.admin.dashboard', compact('users', 'logs', 'signature', 'page_title', 'permissions', 'sorted_permission'));
            }else{
                return view('backend.admin.set_ojt_hours');
            }
        }else{
            return redirect()->route('adminIndex');
        }
    }

    public function logs(){
        $page_title = 'Activity Logs';
        $logs = $this->logs;
        $users = $this->user;
        $permissions = $this->permissions;
        return view('backend.admin.logs', compact('page_title', 'logs', 'users', 'sorted_permission', 'permissions'));
    }

    public function profile(){
        $page_title = 'Profile';
        $users = $this->user;
        $permissions = $this->permissions;
        return view('backend.admin.profile', compact('page_title', 'users', 'sorted_permission', 'permissions'));
    }

    public function collectionAdviser(){
        $page_title = "Adviser's List";
        $users = $this->user;
        $permissions = $this->permissions;
        return view('backend.admin.adviser', compact('page_title', 'users', 'sorted_permission', 'permissions'));
    }

    public function collectionStudent(){
        $page_title = "Student's List";
        $users = $this->user;
        $permissions = $this->permissions;
        return view('backend.admin.student', compact('page_title', 'users', 'sorted_permission', 'permissions'));
    }

    public function courseAndSection(){
        $page_title = "Course and Section";
        $course = $this->course;
        $section = $this->section;
        $users = $this->user;
        $logs = $this->logs;
        $permissions = $this->permissions;
        return view('backend.admin.course', compact('page_title', 'course', 'section', 'users', 'logs', 'sorted_permission', 'permissions'));
    }

    public function company(){
        $page_title = "Companies";
        $users = $this->user;
        $companies = $this->company;
        $permissions = $this->permissions;
        return view('backend.admin.company', compact('page_title', 'users', 'companies', 'sorted_permission', 'permissions'));
    }

    public function setHours(HoursRequest $request){
        $hours = $request->input('hours');

        try{
            $set = $this->hour->find(1)->update([
                'hours' => $hours,
                'academicYear'  => Carbon::today()->subYear()->format('Y').'-'.Carbon::today()->format('Y')
            ]);

            if($set){
                $this->logs->create([
                    'user_id'   => auth('admin')->user()->id,
                    'activity'  => "Set OJT Hours to ".$hours,
                    'role'      => auth('admin')->user()->role
                ]);
            }
        }catch (Exception $e){
            return $e;
        }

        return redirect()->back();
    }

    public function addSection(SectionRequest $request)
    {
        $section = '4' . strtoupper($request->input('section'));

        try {
            $sectionAdded = $this->section->create(['section' => $section]);
        } catch (Exception $e) {
            session()->flash('failed-section', 'Oops... Failed to add section because ' . $e->getMessage());
            return redirect()->back();
        }

        if ($sectionAdded) {
            try {
                $this->logs->create([
                    'user_id' => auth('admin')->user()->id,
                    'activity' => "Added " . $section . " to Sections",
                    'role' => auth('admin')->user()->role
                ]);
            } catch (Exception $e) {
                return $e;
            }

            return redirect()->back();
        }
    }

    public function removeSection($id){
        $decrypted_id = decrypt($id);

        try{
            $section = $this->section->find($decrypted_id)->section;
            $this->section->find($decrypted_id)->delete();
            try{
                $this->logs->create([
                    'user_id'   => auth('admin')->user()->id,
                    'activity'  => "Remove ".$section." to Sections",
                    'role'      => auth('admin')->user()->role
                ]);
            }catch (Exception $e){
                return $e;
            }
        }catch (Exception $e){
            echo $e;
        }

        return redirect()->back();
    }

    public function loadRequest(){
        $users = $this->user;
        $permissions = $this->permissions;
        $to_sort = $permissions->where(['deleted' => 0, 'to' => auth('admin')->user()->id, 'accepted' => 0])->get()->toArray();
        $sorted_permission = array_reverse($to_sort);
        return view('backend.admin.requestHolder', compact('sorted_permission', 'permissions', 'users'));
    }

    public function acceptRequest($id){
        $decrypted_id = decrypt($id);
        try{

            $this->user->where('id', $this->permissions->where('id', $decrypted_id)->first()->user_id)->update(['accepted' => '1']);
            $this->permissions->find($decrypted_id)->update([
                'accepted'  => 1,
                'deleted'   => 1,
                'new'       => 2
            ]);

            $this->notifications->create([
                'to'        => $this->permissions->where('id', $decrypted_id)->first()->user_id,
                'poser'     => auth('admin')->user()->id,
                'event'     => auth('admin')->user()->name.' accepted your request.',
                'removed'   => 0,
                'deleted'   => 0
            ]);

            return redirect()->back();
        }catch (Exception $e){
            return $e;
        }
    }

    public function rejectRequest($id){
        $decrypted_id = decrypt($id);
        try{

            $this->user->where('id', $this->permissions->where('id', $decrypted_id)->first()->user_id)->update(['accepted' => '2']);
            $permit = $this->permissions->find($decrypted_id)->update([
                'accepted'  => 2,
                'deleted'   => 1,
                'new'       => 2
            ]);

            $this->notifications->create([
                'to'        => $permit->user_id,
                'event'     => auth('admin')->user()->name.' rejected your request!',
                'removed'   => 0,
                'deleted'   => 0
            ]);

            $this->user->where('id', $permit->user_id)->update(['accepted' => '1']);

            return redirect()->back();
        }catch (Exception $e){

        }
    }


    public function inbox(){
        $page_title = 'Inbox';
        $users = $this->user;
        $permissions = $this->permissions;
        $notifications = $this->notifications;
        $messages = $this->messages;
        return view('backend.admin.inbox', compact('page_title', 'users', 'sorted_permission', 'permissions', 'notifications', 'messages'));
    }

    public function chat($id){
        $id = decrypt($id);
        $member = $id.'&'.auth('admin')->user()->id;
        $page_title = 'Inbox';
        $users = $this->user;
        $permissions = $this->permissions;
        $notifications = $this->notifications;
        $messages = $this->messages;
        if($this->chat->where(['member' => $member])->count() != 0){
            $chat_id = $this->chat->where(['member' => $member])->first()->chat_id;
        }elseif($this->chat->where(['member' => strrev($member)])->count() != 0) {
            $chat_id = $this->chat->where(['member' => strrev($member)])->first()->chat_id;
        }else{
            $this->chat->create([
                'chat_id' => Str::random(6),
                'member'  => $member
            ]);
            $chat_id = $this->chat->where(['member' => $member])->first()->chat_id;
        }

        $chat = $this->messages->where(['chat_id' => $chat_id])->get();
        $sender = $id;
        return view('backend.admin.chatbox', compact('page_title', 'users', 'sorted_permission', 'permissions', 'notifications', 'messages', 'chat', 'id', 'sender', 'chat_id'));
    }

    public function send(MessageRequest $request, $id, $chat_id){
        $id = decrypt($id);
        $message_info = [
            'chat_id'  => $chat_id,
            'sender'    => auth('admin')->user()->id,
            'receiver'  => $id,
            'message'   => $request->input('message'),
            'new'       => 1,
            'seen'      => 0,
            'deleted'   => 0
        ];

        try{
            $this->messages->create($message_info);

        }catch (Exception $e){
            session()->flash('failed', "cant send message");
            return redirect()->back();
        }


        return redirect()->back();
    }

    public function messages($id){
        $id = decrypt($id);
        $users = $this->user;
        $chat = $this->messages->where(['inbox_id' => $id])->get();
        return view('backend.admin.chats', compact('chat', 'users'));
    }


    public function logout(){
        $this->logs->create([
            'user_id'   => auth('admin')->user()->id,
            'activity'  => "Logout",
            'role'      => auth('admin')->user()->role
        ]);
        auth('admin')->logout();
        session()->forget('adminLogin');
        return redirect()->route('adminIndex');
    }
}
