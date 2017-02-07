<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application 1st level.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the currently authenticated user...
        // $user = Auth::user();
        // Get the currently authenticated user's ID...
        // $id = Auth::id();
        // Check if user authenticated
        // $authenticated = Auth::check(); // true / false
        
        if (Auth::id() < 10 && Auth::check() == true){
            return view('dashboard');
        }else{
            return view('home');
        }
    }
    
    /**
     * Load the Swag
     *
     * @return \Illuminate\Http\Response
     */
    public function loadSwagger()
    {
        //$user = Auth::user();
        return redirect('swagger/index')->with('status', 'Swagger Loaded');

    }
}
