<?php
namespace App\Http\Services;

use App\Models\User;
use App\Models\MessOwner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthService {

    public function getProfile(){
        $user = User::find(auth()->user()->id);
        if($user->hasRole('MESS_OWNER')){
            $user = User::with('mess_owner')->find(auth()->user()->id);
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
        $user = User::create(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'password'=>Hash::make($request->password)]);
        if(!$request->mess_id){
            $mess_owner = MessOwner::create(['user_id'=>$user->id,'country_id'=>$request->country_id,'state_id'=>$request->state_id,'city_id'=>$request->city_id]);
            $user->assignRole('MESS_OWNER');
        }else{
            $user->assignRole('CUSTOMER');
            $user = $user->update(['mess_id'=>$request->mess_id]);
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
        $user = $user->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone]);
        return $user;
    }
    public function changePassword(Object $request){
        $user = User::find($request->user_id);
        $user = $user->update(['passsword'=>Hash::make($request->password)]);
        return $user;
    }
 }


?>
