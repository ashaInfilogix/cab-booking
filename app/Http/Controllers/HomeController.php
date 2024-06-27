<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use App\Models\Setting;
use App\Models\Notification;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function frontend(){

        //$carModels = CarModel::all();
        $settings = Setting::first();
        
        return view('home',compact('settings'));
    }
    public function backend(){

        $notifications = Notification::all();
        $unreadCount = Notification::where('status', 'unread')->count();
        foreach ($notifications as $notification) {
            $notification->timeAgo = Carbon::parse($notification->created_at)->diffForHumans();
        }
    
        return view('admin.index',compact('notifications','unreadCount'));
    }
}
