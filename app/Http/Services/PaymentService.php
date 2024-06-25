<?php
namespace App\Http\Services;

use App\Models\Menu;
use App\Models\MessOwner;
use App\Models\Payment;
use App\Models\Complain;
use App\Models\User;
use App\Http\Services\CustomerService;
use App\Http\Services\CommonService;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PaymentService {

    public function paymentRequestLists($request){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $payments =  Payment::with(['user']);
        $user = User::find(auth()->user()->id);
        if($user->hasRole('MESS_OWNER')){
            $messOwner = MessOwner::where('user_id',$request->user_id)->first();
            $payments = $payments->where('mess_id',$messOwner->id);
        }
        if($user->hasRole('CUSTOMER')){
            $payments = $payments->where('user_id',$request->user_id);
        }
        $payments = $payments->where(function ($query) use ($searchValue){
            $query->whereHas('user',function($query) use ($searchValue){
                $query->where('name','like','%'. $searchValue . '%');
                $query->orWhere('email','like','%'. $searchValue . '%');
                $query->orWhere('phone','like','%'. $searchValue . '%');
            });
        });
        $totalRecords = $payments->count();
        $payments = $payments->offset($request->input('start'))->limit($request->input('length'));
        $payments = $payments->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $payments;
        return $listData;
    }
    public function edit($payment_id){
        return Payment::with(['user'])->find($payment_id);
    }
    public function store(Object $request){
        $payment = Payment::create($request->toArray());
        if($request->hasFile('reference_screenshot') && $request->file('reference_screenshot')->isValid()){
            $payment->addMediaFromRequest('reference_screenshot')->toMediaCollection('PAYMENT_SCREENSHOT');
        }
        $payment = Payment::find($payment->id);
        return $payment;
    }
    public function update(Object $request){
        $payment = Payment::find($request->payment_id);
        $paymentCheckCount = Payment::where('user_id',$payment->user_id)->whereStatus('accept')->count();
        $userDetails = User::find($payment->user_id);
        $parentData = User::find($userDetails->parent_id);
        $result = $payment->update(['status'=>$request->status,'notes'=>$request->notes]);
        $customer = new CustomerService();
        $common = new CommonService();
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $wallet = $customer->user_wallet_updatation($payment->user_id,'credit',$payment->amount);

        if($wallet){
            $common->record_transaction($payment->user_id,$messOwner->id,'credit','REFILL','',$payment->amount,$wallet->payment);
        }
        if($paymentCheckCount == 0){
            $settings = setting();
            $wallets = $customer->user_wallet_updatation($parentData->id,'credit',$settings->referral_fees);
            if($wallet){
                $common->record_transaction($parentData->id,$messOwner->id,'credit','REFERRAL_MONEY','',$settings->referral_fees,$wallets->payment);
            }
        }
        return $payment;
    }
    public function totalPeopleServed(){
        return Payment::distinct('user_id')->count();
    }
 }


?>
