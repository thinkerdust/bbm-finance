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
        $sidebar_cond = "aktif";
        return view('admin.dashboard');
    }

    public function produksi()
    {
        return view('admin.produksi');
    }

    public function addProduksi() 
    {
        return view('produksi.create');
    }
}
