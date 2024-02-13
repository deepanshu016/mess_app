<?php
namespace App\Http\Services;

use App\Models\MessOwner;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class MessOwnerService {

    public function list(){
        $setting =  MessOwner::with('user')->paginate(1);
        return $setting;
    }
    public function edit($owner_id){
        return MessOwner::with('user')->find($owner_id);
    }
    public function store(Object $request){
        $user = User::create(['name'=>$request->mess_owner_name,'email'=>$request->email,'password'=>Hash::make($request->password)]);
        $user->assignRole('MESS_OWNER');
        $mess_owner = MessOwner::create(['user_id'=>$user->id,'mess_name'=>$request->mess_name,'mess_description'=>$request->mess_description,'food_type'=>$request->food_type,'veg_price'=>$request->veg_price,'non_veg_price'=>$request->non_veg_price]);
        $mess_owner = MessOwner::find($mess_owner->id);
        if($request->hasFile('mess_logo') && $request->file('mess_logo')->isValid()){
            $mess_owner->addMediaFromRequest('mess_logo')->toMediaCollection('MESS_LOGO_IMAGE');
        }
        return $mess_owner;
    }
    public function update(Object $request){
        $user = User::find($request->user_id);
        $mess_owner = MessOwner::find($request->mess_owner_id);
        $m = $mess_owner->update(['mess_name'=>$request->mess_name,'mess_description'=>$request->mess_description,'food_type'=>$request->food_type,'veg_price'=>$request->veg_price,'non_veg_price'=>$request->non_veg_price]);
        if($request->hasFile('mess_logo') && $request->file('mess_logo')->isValid()){
            $mess_owner->addMedia($request->file('mess_logo'))->storingConversionsOnDisk('local')->toMediaCollection('MESS_LOGO_IMAGE');
        }
        $user->update(['name'=>$request->mess_owner_name,'email'=>$request->email,'phone'=>$request->phone]);
        return MessOwner::with('user')->find($request->mess_owner_id);
    }
 }


?>
