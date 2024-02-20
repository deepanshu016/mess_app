<?php
namespace App\Http\Services;

use App\Models\MessOwner;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class MessOwnerService {

    public function messOwner(){
        $messOwner =  MessOwner::all();
        return $messOwner;
    }
    public function list($request){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $setting =  MessOwner::with('user')
        ->where(function ($query) use ($searchValue){
            $query->whereHas('user',function($query) use ($searchValue){
                $query->where('name','like','%'. $searchValue . '%');
                $query->orWhere('email','like','%'. $searchValue . '%');
                $query->orWhere('phone','like','%'. $searchValue . '%');
            });
            $query->orWhere('mess_name','like','%'. $searchValue . '%');
            $query->orWhere('mess_description','like','%'. $searchValue . '%');
            $query->orWhere('food_type','like','%'. $searchValue . '%');
        });
        $totalRecords = $setting->count();
        $setting = $setting->offset($request->input('start'))->limit($request->input('length'));
        $setting = $setting->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $setting;
        return $listData;
    }
    public function edit($owner_id){
        return MessOwner::with('user')->find($owner_id);
    }
    public function store(Object $request){
        $user = User::create(['name'=>$request->mess_owner_name,'email'=>$request->email,'password'=>Hash::make($request->password)]);
        $user->assignRole('MESS_OWNER');
        $mess_owner = MessOwner::create(['user_id'=>$user->id,'mess_name'=>$request->mess_name,'mess_description'=>$request->mess_description,'food_type'=>$request->food_type,'veg_breakfast_price'=>$request->veg_breakfast_price,'veg_lunch_price'=>$request->veg_lunch_price,'veg_dinner_price'=>$request->veg_dinner_price,'non_veg_breakfast_price'=>$request->non_veg_breakfast_price,'non_veg_lunch_price'=>$request->non_veg_lunch_price,'non_veg_dinner_price'=>$request->non_veg_dinner_price]);
        $mess_owner = MessOwner::find($mess_owner->id);
        if($request->hasFile('mess_logo') && $request->file('mess_logo')->isValid()){
            $mess_owner->addMediaFromRequest('mess_logo')->toMediaCollection('MESS_LOGO_IMAGE');
        }
        if($request->hasFile('mess_banner') && $request->file('mess_banner')->isValid()){
            $mess_owner->addMediaFromRequest('mess_banner')->toMediaCollection('MESS_BANNER');
        }
        return $mess_owner;
    }
    public function update(Object $request){
        $user = User::find($request->user_id);
        $mess_owner = MessOwner::find($request->mess_owner_id);
        $m = $mess_owner->update(['mess_name'=>$request->mess_name,'mess_description'=>$request->mess_description,'food_type'=>$request->food_type,'veg_breakfast_price'=>$request->veg_breakfast_price,'veg_lunch_price'=>$request->veg_lunch_price,'veg_dinner_price'=>$request->veg_dinner_price,'non_veg_breakfast_price'=>$request->non_veg_breakfast_price,'non_veg_lunch_price'=>$request->non_veg_lunch_price,'non_veg_dinner_price'=>$request->non_veg_dinner_price]);
        if($request->hasFile('mess_logo') && $request->file('mess_logo')->isValid()){
            $mess_owner->clearMediaCollection('MESS_LOGO_IMAGE');
            $mess_owner->addMedia($request->file('mess_logo'))->storingConversionsOnDisk('local')->toMediaCollection('MESS_LOGO_IMAGE');
        }
        if($request->hasFile('mess_banner') && $request->file('mess_banner')->isValid()){
            $mess_owner->clearMediaCollection('MESS_BANNER');
            $mess_owner->addMedia($request->file('mess_banner'))->storingConversionsOnDisk('local')->toMediaCollection('MESS_BANNER');
        }
        $user->update(['name'=>$request->mess_owner_name,'email'=>$request->email,'phone'=>$request->phone]);
        return MessOwner::with('user')->find($request->mess_owner_id);
    }
    public function delete($id){
        $mess_owner = MessOwner::with('user')->find($id);
        $mess_owner->clearMediaCollection('MESS_LOGO_IMAGE');
        $user = User::find($mess_owner->user_id);
        $user->delete();
        return $mess_owner->delete();
    }
 }


?>
