<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AdminService;
use App\Http\Services\MessOwnerService;
use App\Http\Services\CommonService;
use App\Http\Requests\MessOwnerRequest;
use App\Traits\UtilsTrait;
use App\Models\User;
class MessOwnerController extends Controller
{
    use UtilsTrait;
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
        $common = new CommonService();
        $countries = $common->getCountries();
        return view('pages.admin.mess_owner.create',compact('countries'));
    }
    public function list(Request $request)
    {
        $users = new CommonService();
        $service = new MessOwnerService();
        $userDetails = $users->getProfile(['locationPreferences']);
        $locationPreferences = $this->getUserLocationPreferences($userDetails);
        $data = $service->roleWiseList($userDetails,$request,$locationPreferences);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($owner_id)
    {
        $service = new MessOwnerService();
        $messOwner = $service->edit($owner_id);
        $common = new CommonService();
        $countries = $common->getCountries();
        $states = $common->getStateList($messOwner->country_id);
        $cities = $common->getCityList($messOwner->state_id);
        return view('pages.admin.mess_owner.create',compact('messOwner','states','countries','cities'));
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
    public function delete($id)
    {
        $service = new MessOwnerService();
        $service = $service->delete($id);
        if($service){
            return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>'','url'=>route('admin.mess_owner.list')]);
        }
        return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
    }
}
