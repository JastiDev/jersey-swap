<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function get_notifications(){
        $user = Auth::user();
        $page = 2; /* Actual page */
        $limit = 4;
        $notifications = $user->unReadNotifications;
        return view('frontend.pages.notifications.notification',[
            'notifications' => $notifications
        ]);
    }
    public function markAllNotificationAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
    public function markNotificationAsRead($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return back();
    }
}
