<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Class DashboardController extends Controller {
    public function __construct()
    {

    }


    public function index(Request $request)
    {
        return view('pages.admin.dashboard');
    }
}
