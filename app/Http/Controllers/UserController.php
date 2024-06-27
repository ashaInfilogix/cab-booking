<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function login(){
        return view('frontend.login');
    }

    public function loginPost(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            //dd($user->getRoleNames());
            if ($user->hasRole('Admin')) {
                return redirect()->route('admin-home');
            }else{
                return redirect()->route('home');
            }
        }
        
        return  redirect()->route('login')->withErrors(['error' => 'There was an error processing your request.']);
    }

    public function register(){
        return view('frontend.register');
    }

    public function registerPost(Request $request){

        $checkEmail = User::where('email',$request->email)->first();
        if($checkEmail){
            return  redirect()->route('register')->withErrors(['error' => 'This email already exist']);
        }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->assignRole('Customer');
            $user->save();
            return  redirect()->route('register')->with(['success' => 'Register Successfully']);
    }

    public function forgot_password(){
        return view('frontend.forgot-password');
    }

    public function terms(){
        return view('frontend.terms');
    }

    public function adminProfile(){
        return view('admin.profile');
    }

    public function updateProfile(Request $request){

        if($request->hasfile('image')){

            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('assets/img/admin/'), $filename);
            $filePath = 'assets/img/admin/'.$filename;
        
        }else{

            $filePath = '';

        }
        $user = User::find(Auth::id());
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email; 
        $user->contact_number = $request->contact_number;
        $user->profile_pic = $filePath;
        $user->save(); 
        return  redirect()->route('profile')->with(['success' => 'Profile Updated Successfully']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
