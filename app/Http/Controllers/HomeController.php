<?php

namespace App\Http\Controllers;

use App\Temperature;
use Illuminate\Http\Request;
// use Response;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');

    }

    public function data()
    {
        Temperature::create([
            'temperature' => rand(15,18),
        ]);
        $temp = Temperature::latest()->take(10)->get()->sortBy('id');
        $labels = $temp->pluck('created_at');
        $data   = $temp->pluck('temperature');

        $labels = $labels->map(function ($date) {
            return $date->format('H:i:s');
         });
        return response()->json(compact('labels','data'));
        

    }

    
}
