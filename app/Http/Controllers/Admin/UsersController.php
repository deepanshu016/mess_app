<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AdminService;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
class UsersController extends Controller
{

    public function __construct(){

    }

    public function index(Request $request)
    {
        return view('pages.admin.users.list');
    }
    public function add(Request $request)
    {
        $service = new AdminService(Role::class);
        $roleList = $service->getAll($request);
        return view('pages.admin.users.create',compact('roleList'));
    }
    public function list(Request $request)
    {
        $service = new AdminService(User::class);
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($user_id)
    {
        $service = new AdminService(User::class);
        $user = $service->edit($user_id);
        return view('pages.admin.users.create',compact('user'));
    }
    public function save(UserRequest $request)
    {
        $service = new AdminService(User::class);
        $service = $service->store($request,'user_image','USER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.banner.list') : '']);
    }
    public function update(UserRequest $request)
    {
        $service = new AdminService(User::class);
        $service = $service->update($request,'user_image','USER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.banner.list') : '']);
    }
    public function delete($id,Request $request)
    {
        $service = new AdminService(User::class);
        $service = $service->delete($id,'USER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.banner.list') : '']);
    }

    public function getCountries(Request $request){
        $service = new AdminService(Country::class);
        $countryList = $service->getAll($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','data'=>$countryList]);
    }
    public function getStates(Request $request){
        $service = new AdminService(State::class);
        $stateList = $service->getList(['country_id'=>$request->country_id]);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','data'=>$stateList]);
    }
    public function getCities(Request $request){
        $service = new AdminService(City::class);
        $cityList = $service->getList(['state_id'=>$request->state_id]);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','data'=>$cityList]);
    }
}
