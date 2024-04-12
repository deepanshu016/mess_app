<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AdminService;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use App\Models\UserLocation;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\City;
class UsersController extends Controller
{

    public function __construct(){
        $this->middleware(['permission:users-create|users-delete|users-update|users-list']);
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
        $data = $service->list($request,[],['roles']);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($user_id,Request $request)
    {
        $service = new AdminService(User::class);
        $roles = new AdminService(Role::class);
        $roleList = $roles->getAll($request);
        $user = $service->edit($user_id,['roles']);
        return view('pages.admin.users.create',compact('user','roleList'));
    }
    public function save(UserRequest $request)
    {
        $service = new AdminService(User::class);
        $locations = new AdminService(UserLocation::class);
        $service = $service->store($request,'user_image','USER_IMAGE');
        $service->assignRole([$request->role]);
        $location = [];
        if($request->level_type === 'country'){
            $location = $request->country_id;
        }else if($request->level_type === 'state'){
            $location = $request->state_id;
        }else{
            $location = $request->city_id;
        }
        if($location){
            foreach($location as $location){
                $locationData = [
                    'user_id' => $service->id,
                    'locations' => $location
                ];
                $locations->storeAsArray($locationData);
            }
        }
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.users.list') : '']);
    }
    public function update(UserRequest $request)
    {
        $service = new AdminService(User::class);
        $service = $service->update($request,'user_image','USER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.users.list') : '']);
    }
    public function delete($id,Request $request)
    {
        $service = new AdminService(User::class);
        $service = $service->delete($id,'USER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.users.list') : '']);
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
