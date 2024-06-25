<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Class DashboardController extends Controller {
    public function __construct()
    {

    }


    public function index(Request $request)
    {
        // $user = Auth::user();
        // if ($user) {
        //     // Retrieve the role associated with the user
        //     $role = $user->roles->first();
        //     echo "<pre>";
        //     print_r($role); die;
        //     if ($role) {
        //         // Retrieve all permissions associated with the role
        //         $permissions = $role->permissions;
        //         echo "<pre>";
        //         print_r($permissions); die;

        //     } else {
        //         echo "User does not have a role assigned.";
        //     }
        // } else {
        //     echo "User is not logged in.";
        // }
        return view('pages.admin.dashboard');
    }
}
