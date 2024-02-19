<?php
namespace App\Http\Services;

use App\Models\Menu;
use App\Models\MessOwner;
use App\Models\Payment;
use App\Models\CustomerMenu;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CustomerService {

    public function menu(){
        $messOwner = Menu::all();
        return $messOwner;
    }
    public function list($request){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $user =  User::with(['customer_menu','payment'])->whereHas('roles', function ($query) {
            $query->where('name', 'CUSTOMER');
        })
        ->where(function ($query) use ($searchValue){
            $query->whereHas('customer_menu',function($query) use ($searchValue){
                $query->where('meal_type','like','%'. $searchValue . '%');
            });
            $query->whereHas('payment',function($query) use ($searchValue){
                $query->whereDate('expiry', '<', Carbon::today());
            });
            $query->orWhere('name','like','%'. $searchValue . '%');
            $query->orWhere('email','like','%'. $searchValue . '%');
            $query->orWhere('phone','like','%'. $searchValue . '%');
        });
        $totalRecords = $user->count();
        $user = $user->offset($request->input('start'))->limit($request->input('length'));
        $user = $user->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $user;
        return $listData;
    }
    public function edit($customer_id){
        return User::with(['customer_menu','payment'])->find($customer_id);
    }
    public function store(Object $request){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $customer = User::create(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'password'=>Hash::make($request->password),'mess_id'=>$messOwner->id]);
        $customer->assignRole('CUSTOMER');
        // $customer = User::with(['customer_menu','payment'])->find($customer->id);
        // if($request->hasFile('customer_photo') && $request->file('customer_photo')->isValid()){
        //     $customer->addMediaFromRequest('customer_photo')->toMediaCollection('CUSTOMER_PHOTO');
        // }
        // $customermenu = CustomerMenu::create(['user_id'=>$customer->id,'meal_type'=>$request->food_type,'breakfast'=>in_array('breakfast',$request->meal_time) ? 1: 0,'lunch'=>in_array('lunch',$request->meal_time) ? 1: 0,'dinner'=>in_array('lunch',$request->meal_time) ? 1: 0]);
        // if($request->payment_status == 'paid'){
        //     $expiry = date('Y-m-d',strtotime($request->payment_date . ' +30 days'));
        //     $payment = Payment::create([
        //         'user_id'=>$customer->id,
        //         'mess_id'=>$messOwner->id,
        //         'payment_date'=>date('Y-m-d',strtotime($request->payment_date)),
        //         'expiry'=>$expiry
        //     ]);
        //     if($request->hasFile('payment_screenshot') && $request->file('payment_screenshot')->isValid()){
        //         $payment->addMediaFromRequest('payment_screenshot')->toMediaCollection('PAYMENT_SCREENSHOT');
        //     }
        // }
        return $customer;
    }
    public function update(Object $request){
        $user = User::with(['customer_menu','payment'])->find($request->user_id);
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $user->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone]);
        // $customer_menu = CustomerMenu::find($request->customer_menu_id);
        // $customer_menu->update(['meal_type'=>$request->food_type,'breakfast'=>in_array('breakfast',$request->meal_time) ? 1: 0,'lunch'=>in_array('lunch',$request->meal_time) ? 1: 0,'dinner'=>in_array('lunch',$request->meal_time) ? 1: 0]);
        // $payment = Payment::find($request->payment_id);
        // if($request->payment_status == 'paid'){
        //     $expiry = date('Y-m-d',strtotime($request->payment_date . ' +30 days'));
        //     $payment = Payment::create([
        //         'user_id'=>$user->id,
        //         'mess_id'=>$messOwner->id,
        //         'payment_date'=>date('Y-m-d',strtotime($request->payment_date)),
        //         'expiry'=>$expiry
        //     ]);
        // }
        // if($request->hasFile('customer_photo') && $request->file('customer_photo')->isValid()){
        //     $user->clearMediaCollection('CUSTOMER_PHOTO');
        //     $user->addMedia($request->file('customer_photo'))->storingConversionsOnDisk('local')->toMediaCollection('CUSTOMER_PHOTO');
        // }
        // if($request->hasFile('payment_screenshot') && $request->file('payment_screenshot')->isValid()){
        //     $payment->clearMediaCollection('PAYMENT_SCREENSHOT');
        //     $payment->addMedia($request->file('payment_screenshot'))->storingConversionsOnDisk('local')->toMediaCollection('PAYMENT_SCREENSHOT');
        // }
        return $user;
    }
    public function delete($id){
        $user = User::with(['customer_menu','payment'])->find($id);
        $user->clearMediaCollection('CUSTOMER_PHOTO');
        if($user->payment){
            $user->payment->clearMediaCollection('PAYMENT_SCREENSHOT');
        }
        return $user->delete();
    }
 }


?>
