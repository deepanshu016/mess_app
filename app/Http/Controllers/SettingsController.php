<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\SettingsService;
Class SettingsController extends Controller {
    public function __construct()
    {

    }


    public function index(Request $request)
    {
        $settings = new SettingsService();
        $setting = $settings->list();
        return view('pages.admin.settings',compact('setting'));
    }
    public function store(Request $request)
    {
        $settings = new SettingsService();
        $settings = $settings->store($request);
        if($settings){
            return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$settings,'url'=>route('settings')]);
        }
        return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
    }


    public function dummyRoute(Request $request){
        $user = User::find(1);
        return $user->hasRole('ADMIN');
    }
}
