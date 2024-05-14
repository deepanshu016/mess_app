<?php
namespace App\Http\Services;

use App\Models\MessOwner;
use App\Models\MessCuisine;
use App\Models\Cuisine;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

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
    public function allMess($request,$order_by='',$limit=''){
        $food_type = explode(',',json_decode(json_encode($request->food_type),true));
        $page = $request->input('page');
        $messOwner = MessOwner::with(['user', 'country', 'state', 'city','cuisines']);
        if($request->params){
            $messOwner->where(function (Builder $query) use ($request) {
                $pincode = $request->params;
                // Match pincode
                $query->orWhere('pincode', $pincode);
                // Match country name
                $query->orWhereHas('country', function (Builder $query) use ($pincode) {
                    $query->where('name', 'like', "%$pincode%");
                });
                // Match state name
                $query->orWhereHas('state', function (Builder $query) use ($pincode) {
                    $query->where('name', 'like', "%$pincode%");
                });
                // Match city name
                $query->orWhereHas('city', function (Builder $query) use ($pincode) {
                    $query->where('name', 'like', "%$pincode%");
                });
            });
        }
        if($request->food_type){
            $messOwner = $messOwner->whereIn('food_type',$food_type);
        }
        if ($request->cuisine_id) {
            $messOwner->whereHas('cuisines', function ($query) use ($request) {
                $query->where('cuisine_id', $request->cuisine_id);
            });
        }
        if($order_by){
            $messOwner = $messOwner->orderBy('id',$order_by);
        }
        return $messOwner->paginate($limit);
    }
    public function totalMess($request,$food_type){
        $page = $request->input('page');
        $messOwner = MessOwner::with(['user','country','state','city']);
        if($request->params){
            $messOwner->where(function (Builder $query) use ($request) {
                $pincode = $request->params;
                // Match pincode
                $query->orWhere('pincode', $pincode);
                // Match country name
                $query->orWhereHas('country', function (Builder $query) use ($pincode) {
                    $query->where('name', 'like', "%$pincode%");
                });
                // Match state name
                $query->orWhereHas('state', function (Builder $query) use ($pincode) {
                    $query->where('name', 'like', "%$pincode%");
                });
                // Match city name
                $query->orWhereHas('city', function (Builder $query) use ($pincode) {
                    $query->where('name', 'like', "%$pincode%");
                });
            });
        }
        $messOwner = $messOwner->where('food_type',$food_type);
        if($request->pincode){
            $messOwner = $messOwner->where('pincode',$request->pincode);
        }
        return $messOwner->count();
    }
    public function edit($owner_id){
        return MessOwner::with(['user','country','state','city','cuisines'])->find($owner_id);
    }
    public function store(Object $request){
        $user = User::create(['name'=>$request->mess_owner_name,'email'=>$request->email,'password'=>Hash::make($request->password)]);
        $user->assignRole('MESS_OWNER');
        $mess_owner = MessOwner::create([
            'user_id'=>$user->id,
            'mess_name'=>$request->mess_name,
            'mess_description'=>$request->mess_description,
            'food_type'=>$request->food_type,
            'veg_breakfast_price'=>$request->veg_breakfast_price,
            'veg_lunch_price'=>$request->veg_lunch_price,
            'veg_dinner_price'=>$request->veg_dinner_price,
            'non_veg_breakfast_price'=>$request->non_veg_breakfast_price,
            'non_veg_lunch_price'=>$request->non_veg_lunch_price,
            'non_veg_dinner_price'=>$request->non_veg_dinner_price,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'address'=>$request->address,
            'pincode'=>$request->pincode,
            'address_link'=>$request->address_link,
            'is_delivery_boy_available'=>$request->is_delivery_boy_available
        ]);
        if($request->cuisine_id){
            foreach($request->cuisine_id as $cuisine){
                MessCuisine::create(['cuisine_id'=>$cuisine,'mess_id'=>$mess_owner->id]);
            }
        }
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
        $m = $mess_owner->update([
            'mess_name'=>$request->mess_name,
            'mess_description'=>$request->mess_description,
            'food_type'=>$request->food_type,
            'veg_breakfast_price'=>$request->veg_breakfast_price,
            'veg_lunch_price'=>$request->veg_lunch_price,
            'veg_dinner_price'=>$request->veg_dinner_price,
            'non_veg_breakfast_price'=>$request->non_veg_breakfast_price,
            'non_veg_lunch_price'=>$request->non_veg_lunch_price,
            'non_veg_dinner_price'=>$request->non_veg_dinner_price,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'address'=>$request->address,
            'pincode'=>$request->pincode,
            'address_link'=>$request->address_link,
            'is_delivery_boy_available'=>$request->is_delivery_boy_available
        ]);
        MessCuisine::where(['mess_id'=>$request->mess_owner_id])->delete();
        if($request->cuisine_id){
            foreach($request->cuisine_id as $cuisine){
                MessCuisine::create(['cuisine_id'=>$cuisine,'mess_id'=>$mess_owner->id]);
            }
        }
        if(isset($request->account_details)){
            $mess_owner->update(['account_details'=>$request->account_details]);
        }
        if($request->hasFile('mess_logo') && $request->file('mess_logo')->isValid()){
            $mess_owner->clearMediaCollection('MESS_LOGO_IMAGE');
            $mess_owner->addMedia($request->file('mess_logo'))->storingConversionsOnDisk('local')->toMediaCollection('MESS_LOGO_IMAGE');
        }
        if($request->hasFile('mess_banner') && $request->file('mess_banner')->isValid()){
            $mess_owner->clearMediaCollection('MESS_BANNER');
            $mess_owner->addMedia($request->file('mess_banner'))->storingConversionsOnDisk('local')->toMediaCollection('MESS_BANNER');
        }
        if($request->hasFile('qr_code') && $request->file('qr_code')->isValid()){
            $mess_owner->clearMediaCollection('MESS_QR_CODE');
            $mess_owner->addMedia($request->file('qr_code'))->storingConversionsOnDisk('local')->toMediaCollection('MESS_QR_CODE');
        }
        // $user->update(['name'=>$request->mess_owner_name,'email'=>$request->email,'phone'=>$request->phone,'status'=>$request->status]);
        return MessOwner::with('user')->find($request->mess_owner_id);
    }
    public function delete($id){
        $mess_owner = MessOwner::with('user')->find($id);
        $mess_owner->clearMediaCollection('MESS_LOGO_IMAGE');
        $user = User::find($mess_owner->user_id);
        $user->delete();
        return $mess_owner->delete();
    }

    public function getAllCount(){
        return MessOwner::with('user')->where('status',1)->count();
    }


    public function roleWiseList($userDetails,$request,$locationPreferences){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $setting = MessOwner::with('user');
        if(!$userDetails->hasRole('ADMIN')){
            $setting = $setting->whereIn('city_id',$locationPreferences);
        }
        $setting = $setting->where(function ($query) use ($searchValue){
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

    public function getMessCuisines(){
        $user = User::find(auth()->user()->id);
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $cuisineList = MessCuisine::with(['cuisine','mess'])->where('mess_id',$messOwner->id)->groupBy('cuisine_id')->get();
        return $cuisineList;
    }
 }


?>
