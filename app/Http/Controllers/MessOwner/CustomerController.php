<?php

namespace App\Http\Controllers\MessOwner;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Http\Services\CommonService;
use App\Http\Services\MessOwnerService;
use App\Http\Services\AuthService;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Support\Facades\View;
use App\Models\User;
class CustomerController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.mess_owner.customer.list');
    }
    public function add(Request $request)
    {
        $service = new CustomerService();
        return view('pages.mess_owner.customer.create');
    }
    public function list(Request $request)
    {
        $service = new CustomerService();
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($customer_id)
    {
        $service = new CustomerService();
        $customer = $service->edit($customer_id);
        return view('pages.mess_owner.customer.create',compact('customer'));
    }
    public function save(AddCustomerRequest $request)
    {
        DB::beginTransaction();
        try{
            $service = new CustomerService();
            $service = $service->store($request);
            DB::commit();
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.customer.list') : '']);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function update(Request $request)
    {
        try{
            $service = new CustomerService();
            $service = $service->update($request);
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.customer.list') : '']);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function delete($id)
    {
        $service = new CustomerService();
        $service = $service->delete($id);
        if($service){
            return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>'','url'=>route('mess_owner.customer.list')]);
        }
        return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
    }
    public function markAttendancePage($customer_id)
    {
        $service = new CustomerService();
        $customer = $service->edit($customer_id);
        return view('pages.mess_owner.customer.mark_attendance',compact('customer'));
    }
    public function viewTransaction(Request $request)
    {
        $service = new CustomerService();
        $customers = $service->customerList();
        $transaction = $service->filterTransaction($request);
        return view('pages.mess_owner.customer.transaction',compact('customers','transaction'));
    }
    public function markAttendance(AddCustomerRequest $request){
        try{
            $customer = User::find($request->customer_id);
            $attendance = Transaction::where('user_id',$customer->id)->whereDate('transaction_date',date('Y-m-d',strtotime($request->attendance_start)))->first();
            if(empty($attendance)){
                $service = new CustomerService();
                $service = $service->markAttendance($request);
                return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.customer.list') : '']);
            }else{
                return response()->json(['status'=>400,'msg'=>'Attendance already recorded for selected date','url'=>'']);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function filterTransaction(AddCustomerRequest $request){
        try{
            $service = new CustomerService();
            $transaction = $service->filterTransaction($request);
            $html = View::make('pages.common.transaction_data',['transaction'=>$transaction])->render();
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','html'=>$html]);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function referAndEarnPage(Request $request)
    {
        $auth = new AuthService();
        $user = $auth->getProfile();
        return view('frontend.pages.refer_and_earn',compact('user'));
    }
    public function registerViaRefer(Request $request)
    {
        $service = new MessOwnerService();
        $referral_code = $request->referral_code;
        $messList = $service->allMess($request,'DESC',100);
        return view('frontend.pages.register_via_refer',compact('referral_code','messList'));
    }
}
