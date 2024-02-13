<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Class MessDashboardController extends Controller {
    public function __construct()
    {

    }


    public function index(Request $request)
    {
        return view('pages.mess_owner.dashboard');
    }
}
