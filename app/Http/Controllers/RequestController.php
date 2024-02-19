<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Http\Services\RequestService;
use App\Http\Requests\ComplainRequest;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.customer.request.list');
    }
    public function view($request_id)
    {
        $service = new RequestService();
        $requestData = $service->singleRequest($request_id);
        return view('pages.mess_owner.request.view',compact('requestData'));
    }
    public function pendingRequest(Request $request)
    {
        $service = new RequestService();
        $data = $service->pendingRequest();
        return view('pages.mess_owner.request.list',compact('data'));
    }
    public function add(Request $request)
    {
        $service = new RequestService();
        return view('pages.customer.request.create');
    }
    public function list(Request $request)
    {
        $service = new RequestService();
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($customer_id)
    {
        $service = new RequestService();
        $customer = $service->edit($customer_id);
        return view('pages.customer.request.create',compact('customer'));
    }
    public function save(ComplainRequest $request)
    {
        try{
            $service = new RequestService();
            $result = $service->store($request);
            return response()->json(['status'=>($result) ? 200 : 400,'msg'=>($result) ? 'Action performed successfully' : 'Something went wrong','url'=>($result) ? route('customer.request.list') :'']);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function update(Request $request)
    {
        try{
            $service = new RequestService();
            $service = $service->update($request);
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.request.list') : '']);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
}
