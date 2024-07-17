<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use App\Models\Setting;
use App\Models\Notification;
use App\Models\RatingComment;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function frontend(){

        //$carModels = CarModel::all();
        $settings = Setting::first();
        $drivers = User::role('Driver')->with('carDetails')->where('show_on','=','show')->orderBy('position', 'asc')->get();

        foreach ($drivers as $driver) {
            $sumRating = RatingComment::where('driver_id', $driver->driver_id)->sum('rating');
            $totalRecord = RatingComment::where('driver_id', $driver->driver_id)->count();
            $carModel = CarModel::where('id', $driver->carDetails->model_id )->first();
            $driver->model_name = $carModel->model_name;
            if ($totalRecord > 0) {
                $driver->totalRating = number_format(($sumRating) / $totalRecord, 2);
            } else {
                $driver->totalRating = 0; 
            }
        }
        
        return view('home',compact('settings','drivers'));
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
