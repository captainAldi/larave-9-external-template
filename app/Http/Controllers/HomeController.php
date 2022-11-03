<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function proteksi_1()
    {
        echo "Halaman Proteksi 1";
    }

    public function proteksi_1_admin()
    {
        echo "Halaman Proteksi 1 - Admin";
    }

    public function proteksi_1_staff()
    {
        echo "Halaman Proteksi 1 - Staff";
    }

    public function about()
    {
        return view('about');
    }

}
