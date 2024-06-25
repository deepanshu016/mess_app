<?php
namespace App\Http\Services;

use App\Models\Menu;
use App\Models\MessOwner;
use App\Models\Payment;
use App\Models\Complain;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RequestService {

    public function pendingRequest(){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $complain = Complain::with('user')->where('mess_id',$messOwner->id)->get();
        return $complain;
    }
    public function singleRequest($request_id){
        $complain = Complain::with('user')->find($request_id);
        return $complain;
    }
    public function list($request){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $complain =  Complain::where(function ($query) use ($searchValue){
            $query->orWhere('title','like','%'. $searchValue . '%');
            $query->orWhere('description','like','%'. $searchValue . '%');
        });
        $totalRecords = $complain->count();
        $complain = $complain->offset($request->input('start'))->limit($request->input('length'));
        $complain = $complain->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $complain;
        return $listData;
    }
    public function edit($customer_id){
        return User::with(['customer_menu','payment'])->find($customer_id);
    }
    public function store(Object $request){
        $complain = Complain::create(['user_id'=>auth()->user()->id,'mess_id'=>auth()->user()->mess_id,'title'=>$request->subject,'description'=>$request->description,'status'=>'pending']);
        if($request->hasFile('reference_doc') && $request->file('reference_doc')->isValid()){
            $complain->addMediaFromRequest('reference_doc')->toMediaCollection('REQUEST_REFERENCE_DOC');
        }
        $complain = Complain::find($complain->id);
        return $complain;
    }
    public function update(Object $request){
        $complain = Complain::find($request->request_id);
        $complain = $complain->update(['status'=>$request->status,'updated_at'=>date('Y-m-d H:i:s')]);
        return $complain;
    }
 }


?>
