<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class NotificationController extends Controller
{
    public function notifications(){
        $unreadNotifications =auth()->user()->unreadNotifications;

        return view('admin.notifications', compact('unreadNotifications'));
    }
    public function  readAll()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        $unreadNotifications->each(function($notification){
            $notification->markAsRead();
        });
        flash('Notificações lida com sucesso')->success();
        Return redirect()->back();
    }

    public function read($notification){
        $notification = auth()->user()->notifications()->find($notification);
        $notification->markAsRead();
        flash('Notificão lida com sucesso')->success();
        Return redirect()->back();


       

    }
}
