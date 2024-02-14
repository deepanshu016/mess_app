<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Services\MessOwnerService;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use App\Models\User;
Class AuthController extends Controller {
    public function __construct()
    {

    }

    public function register(Request $request)
    {
        $service = new MessOwnerService();
        $data = $service->messOwner();
        return view('auth.register',compact('data'));
    }
    public function becomeAMessOwner(Request $request)
    {

        return view('auth.register');
    }
    public function login(LoginRequest $request)
    {
        $auth = new AuthService();
        $login = $auth->login($request);
        if($login){
            $user = User::find(auth()->user()->id);
            if($user->hasRole('ADMIN')){
                $url = route('admin.dashboard');
            }elseif($user->hasRole('MESS_OWNER')){
                $url = route('mess_owner.dashboard');
            }else{
                $url = route('customer.dashboard');
            }
            return response()->json(['status'=>200,'msg'=>'Logged in successfully','url'=>$url]);
        }else{
            return response()->json(['status'=>400,'msg'=>'Credentials not matched','data'=>[],'url'=>'']);
        }
    }
    public function registration(RegisterRequest $request)
    {
        $auth = new AuthService();
        $result = $auth->signup($request);
        if($result){
            return response()->json(['status'=>200,'msg'=>'Registration done successfully','data'=>$result,'url'=>route('login')]);
        }else{
            return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
        }
    }
}
