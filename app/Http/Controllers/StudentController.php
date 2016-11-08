<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Company;
use App\Course;
use App\Dtr;
use App\Hour;
use App\Http\Requests\TimeInRequest;
use App\Message;
use App\Notification;
use App\Period;
use App\Profile;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Jcf\Geocode\Geocode;

class StudentController extends Controller
{
    public function __construct(User $user, Notification $notification, Message $message, Choice $choice, Hour $hour, Company $company, Profile $profile, Course $course, Dtr $dtr, Period $period){
        $this->user = $user;
        $this->notification = $notification;
        $this->message = $message;
        $this->choice = $choice;
        $this->hour = $hour;
        $this->company = $company;
        $this->profile = $profile;
        $this->course = $course;
        $this->dtr = $dtr;
        $this->period = $period;

        session_start();
    }

    public function index(){
        $messages = $this->message;
        $notifications = $this->notification;
        $users = $this->user;
        $choices = $this->choice->where('user_id', auth()->user()->id)->get();
        $company = $this->company;
        $course =  $this->course->find($users->find(auth()->user()->id)->profile->course);
        $progress = ($users->find(auth()->user()->id)->profile->number_of_hours_rendered / 60 /60) * 100 / $this->hour->find(1)->hours;
        $hours = $this->hour->find(1);
        $dtr = $this->dtr->where(['user_id' => auth()->user()->id])->get();
        $today_record = $this->dtr->where(['user_id' => auth()->user()->id, 'date' => Carbon::now()->format('Y-m-d')]);

        return view('frontend.users.students.dashboard', compact('messages', 'notifications', 'users', 'choices', 'company', 'course', 'progress', 'hours', 'dtr', 'today_record'));
    }

    public function recommendation($id){
        if(!auth()->guest()){
            if(auth()->user()->confirmed == 1){
                $messages = $this->message;
                $notifications = $this->notification;
                $users = $this->user;
                $user_profile = $this->user->find(auth()->user()->id)->profile;
                $company_choice = $this->choice->where(['user_id' => auth()->user()->id, 'id' => $id])->first();
                return view('frontend.users.students.letterHolder_recommendation', compact('company_choice', 'user_profile', 'messages', 'notifications', 'users'));
            }
        }
    }

    public function recommendationLetter($id){
        $users = $this->user;
        $company_choice = $this->choice->where(['user_id' => auth()->user()->id, 'id' => $id])->first();
        $hours = $this->hour->find(1);
        return view('frontend.users.students.forms.recommendation', compact('company_choice', 'users', 'hours'));
    }

    public function addCompany(Request $request){
        try{
            if($this->choice->where(['user_id' => auth()->user()->id, 'name' => $request->input('company_name')])->count() == 0){
                $this->choice->create([
                    'user_id'   => auth()->user()->id,
                    'name'      => $request->input('company_name'),
                    'address'   => $request->input('company_address'),
                    'lat'       => $request->input('company_lat'),
                    'lng'       => $request->input('company_lng')
                ]);
                return redirect()->back();
            }else{
                return 'duplicate company choice';//change to session
            }
        }catch (Exception $e){
            return $e; //change to session
        }
    }

    public function setCompany($id){
        $chosen = $this->choice->find($id);

        if($this->company->where('name', $chosen->name)->count() == 0){
            $my_company = $this->company->create([
                'name'      => $chosen->name,
                'address'   => $chosen->address,
                'latitude'  => $chosen->lat,
                'longitude' => $chosen->lng
            ]);
        }else{
            $my_company = $this->company->where(['name' => $chosen->name])->first();
        }

        $this->profile->where(['user_id' => auth()->user()->id])->update(['company_id' => $my_company->id]);

        return redirect()->back();
    }

    public function timeIn(Request $request){
//    public function timeIn(TimeInRequest $request){
//        checking distance
//        $latFrom = deg2rad($request->input('myLat'));
//        $lonFrom = deg2rad($request->input('myLng'));
//        $latTo = deg2rad($this->company->find($this->user->find(auth()->user()->id)->profile->company_id)->first()->latitude);
//        $lonTo = deg2rad($this->company->find($this->user->find(auth()->user()->id)->profile->company_id)->first()->longitude);
//        $earthRadius = 6371000;
//
//        $latDelta = $latTo - $latFrom;
//        $lonDelta = $lonTo - $lonFrom;
//
//        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
//                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
//        $distance = $angle * $earthRadius;
//
//        if($distance > 50){
//            session()->flash('far', 'Too Far from the company');
//            return redirect()->back();
//        }else{

                if($this->period->where(['user_id' => auth()->user()->id])->count() == 0){
                    $this->period->create([
                        'user_id'       => auth()->user()->id,
                        'date_started'  => Carbon::now()->format('Y-m-d')
                    ]);
                }

                $starting_period = $this->period->where(['user_id' => auth()->user()->id])->first();

                if($this->dtr->where(['user_id' => auth()->user()->id, 'date' => Carbon::now()->format('Y-m-d')])->count() == 0){
                    $this->dtr->create([
                        'user_id'       => auth()->user()->id,
                        'date'          => Carbon::now()->format('Y-m-d'),
                        'status'        => 1,
                        'week_no'       => Carbon::now()->diffInWeeks($starting_period->created_at) + 1,
                        'updated_at'    => 0
                    ]);

                    session(['time-in' => 'in']);
                    return redirect()->back();
                }
//        }
    }

    public function timeOut(){
        //        checking distance
//        $latFrom = deg2rad($request->input('myLat'));
//        $lonFrom = deg2rad($request->input('myLng'));
//        $latTo = deg2rad($this->company->find($this->user->find(auth()->user()->id)->profile->company_id)->first()->latitude);
//        $lonTo = deg2rad($this->company->find($this->user->find(auth()->user()->id)->profile->company_id)->first()->longitude);
//        $earthRadius = 6371000;
//
//        $latDelta = $latTo - $latFrom;
//        $lonDelta = $lonTo - $lonFrom;
//
//        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
//                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
//        $distance = $angle * $earthRadius;
//
//        if($distance > 50){
//            session()->flash('far', 'Too Far from the company');
//            return redirect()->back();
//        }else{

            $this->dtr->where(['user_id' => auth()->user()->id, 'date' => Carbon::now()->format('Y-m-d')])->update([
                'status' => 0
            ]);

            $progress_today =  $this->dtr->where(['user_id' => auth()->user()->id, 'date' => Carbon::now()->format('Y-m-d')])->first();

            $rendered = $this->user->find(auth()->user()->id)->profile->number_of_hours_rendered;
            $this->user->find(auth()->user()->id)->profile->update([
                'number_of_hours_rendered' => $rendered + $progress_today->created_at->diffInSeconds($progress_today->updated_at)
            ]);

            session()->forget('time-in');
            return redirect()->back();
//        }
    }

    public function logout(){
        auth()->logout();
        return redirect()->back();
    }
}
