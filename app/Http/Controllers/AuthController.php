<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Services\MessOwnerService;
use App\Http\Services\CommonService;
use App\Models\MessOwner;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Auth;
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
    public function userProfile(Request $request)
    {
        $auth = new AuthService();
        $user = $auth->getProfile();
        $service = new MessOwnerService();
        $messOwner = MessOwner::where('user_id',$user->id)->first();
        $common = new CommonService();
        $countries = $common->getCountries();
        if(isset($messOwner->country_id)){
            $states = $common->getStateList($messOwner->country_id);
        }else{
            $states = [];
        }
        if(isset($messOwner->state_id)){
            $cities = $common->getCityList($messOwner->state_id);
        }else{
            $cities = [];
        }
        return view('pages.profile',compact('user','messOwner','countries','states','cities'));
    }
    public function loginAsGuestLogin($user_id)
    {
        $auth = Auth::loginUsingId($user_id);
        return redirect(route('mess_owner.dashboard'))->with('success','Loggedin successfully !!!');
    }
    public function login(LoginRequest $request)
    {
        $auth = new AuthService();
        $login = $auth->login($request);
        if($login){
            $user = User::find(auth()->user()->id);
            if($user->status == 'inactive'){
                return response()->json(['status'=>400,'msg'=>'Account Inactive ,please contact to admin','url'=>'']);
            }
            if($user->hasRole('ADMIN')){
                $url = route('admin.dashboard');
            }elseif($user->hasRole('MESS_OWNER')){
                $url = route('mess_owner.dashboard');
            }else{
                $url = route('home');
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

    public function updateProfile(UpdateProfileRequest $request){
        try{
            $auth = new AuthService();
            $result = $auth->updateProfile($request);
            return response()->json(['status'=>($result) ? 200 : 400,'msg'=>($result) ? 'Profile updated successfully' : 'Something went wrong','url'=>route('user.profile')]);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function changePassword(ChangePasswordRequest $request){
        try{
            $auth = new AuthService();
            $result = $auth->changePassword($request);
            return response()->json(['status'=>($result) ? 200 : 400,'msg'=>($result) ? 'Password updated successfully' : 'Something went wrong','url'=>route('user.profile')]);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function savePaymentDetails(Request $request)
    {
        $service = new MessOwnerService();
        $service = $service->update($request);
        if($service){
            return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$service,'url'=>route('user.profile')]);
        }
        return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
    }
}
