<?php

namespace App\Http\Controllers\MessOwner;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\DB;

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
    public function markAttendance(AddCustomerRequest $request){
        try{
            $service = new CustomerService();
            $service = $service->markAttendance($request);
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.customer.list') : '']);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
}
