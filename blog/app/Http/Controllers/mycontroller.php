<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mycontroller extends Controller
{
    public function testEmail(){
        $data = array('info'=>'xin chào bạn đây là email test');
        Mail::send('mail', $data, function($message){
            $message->from('thang.vuquoc.315@gmail.com', 'Quyết Thắng');
            $message->to('luxuryhackerr@gmail.com', 'Visitor')->subject('Hello');
        });
    }
}
