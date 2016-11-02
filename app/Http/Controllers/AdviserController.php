<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Http\Requests\MessageRequest;
use App\Log;
use App\Message;
use App\Notification;
use App\Permission;
use App\Signature;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;

class AdviserController extends Controller
{
    public function __construct(User $user, Log $log, Signature $signature, Permission $permission, Notification $notification, Message $message, Chat $chat){
        $this->users = $user;
        $this->log = $log;
        $this->signatures = $signature;
        $this->permission = $permission;
        $this->notification = $notification;
        $this->messages = $message;
        $this->chat = $chat;

        session_start();
    }

    public function index(){
        if(session()->has('userLogin')){
            $page_title = 'Dashboard';
            $logs = $this->log;
            $signature = $this->signatures;
            $users = $this->users;
            $permissions = $this->permission;
            $messages = $this->messages;
            $notifications = $this->notification;

            return view('frontend.users.advisers.dashboard', compact('page_title', 'logs', 'users', 'signature', 'permissions', 'notifications', 'messages'));
        }else{
            return redirect()->route('index');
        }
    }

    public function loadRequest(){
        $users = $this->users;
        $permissions = $this->permission;
        $to_sort = $permissions->where(['deleted' => 0, 'to' => auth()->user()->id, 'accepted' => 0])->get()->toArray();
        $sorted_permission = array_reverse($to_sort);
        return view('frontend.users.advisers.requestHolder', compact('sorted_permission', 'permissions', 'users'));
    }

    public function loadNotification(){
        $users = $this->users;
        $notifications = $this->notification;
        $to_sort = $notifications->where(['deleted' => 0, 'to' => auth()->user()->id])->get()->toArray();
        $sorted_notifications = array_reverse($to_sort);
        return view('frontend.users.advisers.notificationHolder', compact('sorted_notifications', 'notifications', 'users'));
    }

    public function removeNotification($id){
        $id = decrypt($id);

        $this->notification->find($id)->update(['removed' => 1]);
        return redirect()->back();
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
        $page_title = "Student's List";
        $users = $this->users;
        $permissions = $this->permission;
        $notifications = $this->notification;

        return view('frontend.users.advisers.myStudents', compact('page_title', 'users', 'sorted_permission', 'permissions', 'notifications'));
    }

    public function showLogs(){
        if(session()->has('userLogin')) {
            $deletedLogs = false;
            $users = $this->users;
            $logs = $this->log;
            $permissions = $this->permission;
            $notifications = $this->notification;

            return view('frontend.users.advisers.logs', compact('logs', 'users', 'deletedLogs',  'sorted_permission', 'permissions', 'notifications'));
        }else {
            return redirect()->route('index');
        }
    }

    public function inbox(){
        $page_title = 'Inbox';
        $users = $this->users;
        $permissions = $this->permission;
        $notifications = $this->notification;
        $messages = $this->messages;
        return view('frontend.users.advisers.inbox', compact('page_title', 'users', 'sorted_permission', 'permissions', 'notifications', 'messages'));
    }

    public function chat($id){
        $id = decrypt($id);
        $member = $id.'&'.auth()->user()->id;
        $page_title = 'Inbox';
        $users = $this->users;
        $permissions = $this->permission;
        $notifications = $this->notification;
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
        return view('frontend.users.advisers.chatbox', compact('page_title', 'users', 'sorted_permission', 'permissions', 'notifications', 'messages', 'chat', 'id', 'sender', 'chat_id'));
    }

    public function send(MessageRequest $request, $id, $chat_id){
        $id = decrypt($id);
        $message_info = [
            'chat_id'  => $chat_id,
            'sender'    => auth()->user()->id,
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

    public function profile(){
        $page_title = 'Profile';
        $users = $this->users;
        $permissions = $this->permission;
        $notifications = $this->notification;
        return view('frontend.users.advisers.profile', compact('page_title', 'users', 'sorted_permission', 'permissions', 'notifications'));
    }
}
