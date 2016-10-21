<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){

    }

    public function send(){
        $data = ['sample' => 'jimuel palaca'];
        try {
            Mail::send('mail.template', $data, function($msg)use($data){
                $msg->to('genchancer056@gmail.com', 'Genesis Pungasi Palaca')->subject('Sample Email');
                $msg->from('ojttracker@gmail.com', 'OJT Monitoring BOTS');
            });
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
