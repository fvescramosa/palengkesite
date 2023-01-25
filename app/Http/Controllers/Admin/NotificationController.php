<?php

namespace App\Http\Controllers\Admin;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function show(){

        $notifs = Notification::all();
        return view('admin.notifications.show', compact(['notifs']));
    }
}
