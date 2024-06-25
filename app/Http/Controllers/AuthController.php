<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Services\MessOwnerService;
use App\Models\MessOwner;
use App\Http\Services\AuthService;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
Class AuthController extends Controller {

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function register(Request $request)
    {
        $type = 'customer';
        $service = new MessOwnerService();
        $data = $service->messOwner();
        return view('auth.register',compact('data','type'));
    }
    public function becomeAMessOwner(Request $request)
    {
        $type = 'mess_owner';
        $common = new CommonService();
        $countries = $common->getCountries();
        return view('auth.register',compact('type','countries'));
    }
    public function userProfile(Request $request)
    {
        $auth = new AuthService();
        $user = $auth->getProfile();
        $service = new MessOwnerService();
        $messOwner = MessOwner::with(['cuisines'])->where('user_id',$user->id)->first();

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
        $messCuisines = [];
        if(!empty($messOwner->cuisines)){
            foreach($messOwner->cuisines as $key=>$cuisine){
                array_push($messCuisines,$cuisine->cuisine_id);
            }
        }
        if($user->hasRole('MESS_OWNER')){
            $cuisinesList = $service->getMessCuisines();
            $messOwner->mess_cuisines = $messCuisines;
        }else{
            $cuisinesList = [];
        }

        return view('pages.profile',compact('user','messOwner','countries','states','cities','cuisinesList'));
    }
    public function loginAsGuestLogin($user_id,Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->session()->invalidate();
        $auth = Auth::loginUsingId($user_id);
        $user = User::find($auth->id);
        if($user->hasRole('MESS_OWNER')){
            return redirect(route('mess_owner.dashboard'))->with('success','Loggedin successfully !!!');
        }else if($user->hasRole('CUSTOMER')){
            return redirect(route('view.profile'))->with('success','Loggedin successfully !!!');
        }else{
            return redirect(route('admin.dashboard'))->with('success','Loggedin successfully !!!');
        }
    }
    public function login(LoginRequest $request)
    {
        $auth = new AuthService();
        $login = $auth->login($request);
        if($login){
            $user = User::find(auth()->user()->id);

            if($user->hasRole('CUSTOMER')){
                $url = route('home');
            }else if($user->hasRole('MESS_OWNER')){
                if($user->status == 'inactive'){
                    return response()->json(['status'=>400,'msg'=>'Account Inactive ,please contact to admin','url'=>'']);
                }
                $url = route('mess_owner.dashboard');
            }else{
                $url = route('admin.dashboard');
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
            $user = User::find($result->id);
            if($user){
                if($user->hasRole('ADMIN')){
                    $login = $auth->login($request);
                    $url = route('admin.dashboard');
                }elseif($user->hasRole('MESS_OWNER')){
                    $url = route('home');
                }else{
                    $login = $auth->login($request);
                    $url = route('home');
                }
            }
            return response()->json(['status'=>200,'msg'=>'Registration done successfully','data'=>$result,'url'=>$url]);
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
