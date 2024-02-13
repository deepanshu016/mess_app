<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MessOwnerService;
use App\Http\Requests\MessOwnerRequest;
class MessOwnerController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.admin.mess_owner.list');
    }
    public function add(Request $request)
    {
        $service = new MessOwnerService();
        $setting = $service->list();
        return view('pages.admin.mess_owner.create',compact('setting'));
    }
    public function list(Request $request)
    {
        $service = new MessOwnerService();
        $data = $service->list();
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data->items(),'draw'=>$request->input('draw'),'recordsTotal'=>$data->total(),'recordsFiltered' => $data->total()]);
    }
    public function edit($owner_id)
    {
        $service = new MessOwnerService();
        $messOwner = $service->edit($owner_id);
        return view('pages.admin.mess_owner.create',compact('messOwner'));
    }
    public function save(MessOwnerRequest $request)
    {
        $service = new MessOwnerService();
        $service = $service->store($request);
        if($service){
            return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$service,'url'=>route('admin.mess_owner.list')]);
        }
        return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
    }
    public function update(Request $request)
    {
        $service = new MessOwnerService();
        $service = $service->update($request);
        if($service){
            return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$service,'url'=>route('admin.mess_owner.list')]);
        }
        return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
    }
}
