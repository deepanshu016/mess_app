<?php

namespace App\Http\Controllers\MessOwner;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\Gate;


use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function __construct()
    {

    }
    public function manage_subscription($customer_id)
    {
        $service = new CustomerService();
        $customer = $service->edit($customer_id);
        return view('pages.mess_owner.customer.manage_subscription',compact('customer'));
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
    public function save_manage_subscription(AddCustomerRequest $request)
    {
        try{
            $service = new CustomerService();
            $service = $service->save_subscription($request);
            if (Gate::allows('mess_owner')) {
                $route = route('mess_owner.customer.list');
            }else{
                $route = route('admin.customer.list');
            }
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? $route : '']);
        }catch(\Exception $e){
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
}
