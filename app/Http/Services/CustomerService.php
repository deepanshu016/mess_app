<?php
namespace App\Http\Services;

use App\Models\Menu;
use App\Models\MessOwner;
use App\Models\Payment;
use App\Models\CustomerMenu;
use App\Http\Services\CommonService;
use App\Models\Attendance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CustomerService {

    public function menu(){
        $messOwner = Menu::all();
        return $messOwner;
    }
    public function customerList(){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        if(!empty($messOwner)){
            $customer = User::where('mess_id',$messOwner->id)->get();
        }else{
           $customer = [];
        }
        return $customer;
    }
    public function list($request){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $user = User::with(['customer_menu','payments','attendances'])->whereHas('roles', function ($query) {
            $query->where('name', 'CUSTOMER');
        })
        ->where(function ($query) use ($searchValue){
            $query->whereHas('customer_menu',function($query) use ($searchValue){
                $query->where('meal_type','like','%'. $searchValue . '%');
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
        return User::with(['customer_menu','payments'])->find($customer_id);
    }
    public function save_subscription(Object $request){
        $common = new CommonService();
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $customer = User::with(['customer_menu','payments'])->find($request->customer_id);
        $wallet = $this->user_wallet_updatation($customer->id,'credit',$request->refill_amount);
        if($wallet){
            $common->record_transaction($customer->id,$messOwner->id,'credit','REFILL','',$request->refill_amount,$wallet->payment);
        }
        return $customer;

    }
    public function store(Object $request){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $customer = User::create(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'password'=>Hash::make($request->password),'mess_id'=>$messOwner->id,'payment'=>$request->payment,'subscription_starts_at'=>date('Y-m-d',strtotime($request->subscription_starts_at))]);
        $customer->assignRole('CUSTOMER');
        return $customer;
    }
    public function update(Object $request){
        $user = User::with(['customer_menu','payments'])->find($request->user_id);
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $user->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'status'=>$request->status]);
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


    public function markAttendance(Object $request){
        $common = new CommonService();
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $customer = User::find($request->customer_id);
        $totalSpend = getTotalPerDay($customer->id,$messOwner->id,$request->meal_time);
        $wallet = $this->user_wallet_updatation($customer->id,'debit',$totalSpend);
        if($wallet){
            $common->record_transaction($customer->id,$messOwner->id,'debit','SPEND',$request->attendance_start,$totalSpend,$wallet->payment);
        }
        return $wallet;
    }
    public function filterTransaction(Object $request){
        $transaction = Transaction::with(['user','mess_owner']);
        if($request->user_id){
            $transaction = $transaction->where('user_id',$request->user_id);
        }
        if($request->transaction_type){
            $transaction = $transaction->where('transaction_type',$request->transaction_type);
        }
        if($request->month){
            $transaction = $transaction->whereMonth('transaction_date',$request->month);
        }
        $transaction = $transaction->orderBy('transaction_date','DESC')->get();
        return $transaction;
    }
    public function transactionDataTables(Object $request){
        $transaction = Transaction::with(['user','mess_owner']);
        if($request->user_id){
            $transaction = $transaction->where('user_id',$request->user_id);
        }
        if($request->transaction_type){
            $transaction = $transaction->where('transaction_type',$request->transaction_type);
        }
        if($request->month){
            $transaction = $transaction->whereMonth('transaction_date',$request->month);
        }
        $totalRecords = $transaction->count();
        $transaction = $transaction->offset($request->input('start'))->limit($request->input('length'));
        $transaction = $transaction->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $transaction;
        return $listData;
    }
    public function user_wallet_updatation($customer_id,$type,$amount){
        $user = User::find($customer_id);
        if($type == 'debit'){
            $user->decrement('payment', $amount);
        }else{
            $user->increment('payment', $amount);
        }
        $user = User::find($customer_id);
        return $user;
    }

    public function getAllCustomer(){
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'CUSTOMER');
        })->count();
    }


    public function assignMess(Object $request){
        $user = User::find(auth()->user()->id);
        $customer = $user->update(['mess_id'=>$request->mess_id]);
        return $customer;
    }
 }


?>
