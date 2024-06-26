<?php
namespace App\Http\Services;

use App\Models\User;
use App\Models\MessOwner;
use App\Models\MessCuisine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthService {

    public function getProfile(){
        $user = User::find(auth()->user()->id);
        if($user->hasRole('MESS_OWNER')){
            $user = User::with('mess_owner')->find(auth()->user()->id);
        }else{
            $user = User::with('assigned_mess','assigned_mess.country','assigned_mess.state','assigned_mess.city')->find(auth()->user()->id);
        }
        return $user;
    }
    public function login(Object $request){
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return true;
        }else{
            return false;
        }
    }
    public function signup(Object $request){
        $customer = new CustomerService();
        $common = new CommonService();
        if($request->signup_type  != 'customer'){
            $user = User::create(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'password'=>Hash::make($request->password),'status'=>'inactive']);
            $mess_owner = MessOwner::create(['user_id'=>$user->id,'country_id'=>$request->country_id,'state_id'=>$request->state_id,'city_id'=>$request->city_id,'is_delivery_boy_available'=>$request->is_delivery_boy_available]);
            $user->assignRole('MESS_OWNER');
            if($request->cuisine_id){
                foreach($request->cuisine_id as $cuisine){
                    MessCuisine::create(['cuisine_id'=>$cuisine,'mess_id'=>$mess_owner->id]);
                }
            }
        }else{
            $user = User::create(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'password'=>Hash::make($request->password)]);
            $user->assignRole('CUSTOMER');
            $customer = $user;
            $referral_code = 'FD'.$user->id.date('Y');
            if($request->referral_code){
                $referrelDetail = User::where('referral_code',$request->referral_code)->first();
                $parent_id = $referrelDetail->id;
                $wallets = $customer->user_wallet_updatation($parent_id,'credit',50);
                if($wallets){
                    $common->record_transaction($parent_id,$user->id,'credit','REFERRAL_MONEY','',50,$wallets->payment);
                }
            }else{
                $parent_id =  NULL;
            }
            $user = $user->update(['mess_id'=>$request->mess_id,'referral_code'=>$referral_code,'parent_id'=>$parent_id]);
            $user = User::find($customer->id);
        }
        return $user;
    }
    public function updateProfile(Object $request){
        if($request->mess_owner_id){
            $mess_owner = MessOwner::find($request->mess_owner_id);
            if($request->hasFile('mess_logo') && $request->file('mess_logo')->isValid()){
                $mess_owner->clearMediaCollection('MESS_LOGO_IMAGE');
                $mess_owner->addMediaFromRequest('mess_logo')->toMediaCollection('MESS_LOGO_IMAGE');
            }
            $mess_owner = $mess_owner->update(['mess_name'=>$request->mess_name,'mess_description'=>$request->mess_description]);
        }
        $user = User::find($request->user_id);
        $user = $user->update(['name'=>$request->name,'phone'=>$request->phone]);
        return $user;
    }
    public function changePassword(Object $request){
        $user = User::find($request->user_id);
        $user = $user->update(['passsword'=>Hash::make($request->password)]);
        return $user;
    }
 }


?>
