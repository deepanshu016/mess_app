<?php
namespace App\Http\Services;

use App\Models\User;
use App\Models\MessOwner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthService {

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
            $mess_owner = MessOwner::create(['user_id'=>$user->id]);
            $user->assignRole('MESS_OWNER');
        }else{
            $user->assignRole('CUSTOMER');
        }
        return $user;
    }
 }


?>
