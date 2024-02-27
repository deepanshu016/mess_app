<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Services\MessOwnerService;
use App\Http\Services\CommonService;
use App\Http\Services\BannerService;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\User;
Class CommonController extends Controller {
    public function __construct()
    {

    }

    public function getStateList(Request $request)
    {
        $html = '';
        $service = new CommonService();
        $data = $service->getStateList($request->country_id);
        if(!empty($data)){
            $html .= '<div class="form-group"> <label class="form-label">State</label>';
            $html .= '<select class="form-control get-city" name="state_id">';
            $html .= '<option value="">Select State</option>';
            foreach($data as $data){
                $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
        }
        return response()->json(['status'=>200,'msg'=>'Logged in successfully','html'=>$html]);
    }
    public function getCityList(Request $request)
    {
        $html = '';
        $service = new CommonService();
        $data = $service->getCityList($request->state_id);
        if(!empty($data)){
            $html .= '<div class="form-group"> <label class="form-label">City</label>';
            $html .= '<select class="form-control" name="city_id">';
            $html .= '<option value="">Select City</option>';
            foreach($data as $data){
                $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
        }
        return response()->json(['status'=>200,'msg'=>'Logged in successfully','html'=>$html]);
    }
    public function becomeAMessOwner(Request $request)
    {
        return view('auth.register');
    }
    public function userProfile(Request $request)
    {
        $auth = new AuthService();
        $user = $auth->getProfile();
        return view('pages.profile',compact('user'));
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

    public function updateProfile(UpdateProfileRequest $request){
        try{
            $auth = new AuthService();
            $result = $auth->updateProfile($request);
            return response()->json(['status'=>($result) ? 200 : 400,'msg'=>($result) ? 'Profile updated successfully' : 'Something went wrong','url'=>route('profile')]);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function deleteMedia(GalleryRequest $request)
    {
        $service = new BannerService(Media::class);
        $service = $service->deleteMedia($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.gallery.list') : '']);
    }
}
