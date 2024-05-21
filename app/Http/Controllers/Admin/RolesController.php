<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
class RolesController extends Controller
{
    public function __construct() {

    }


    public function index(Request $request){
        return view('pages.admin.roles.index');
    }
    public function create(Request $request){
        return view('pages.admin.roles.create');
    }
    public function list(Request $request){
        $service = new BannerService(Role::class);
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function rolePermission($role_id,Request $request){
        $service = new BannerService(Permission::class);
        $service1 = new BannerService(Role::class);
        $permission = $service->getAll($request);
        $role = $service1->edit($role_id);
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role_id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('pages.admin.roles.permission',compact('permission','role','rolePermissions'));
    }


    public function edit($banner_id)
    {
        $service = new BannerService(Role::class);
        $role = $service->edit($banner_id);
        return view('pages.admin.roles.create',compact('role'));
    }
    public function save(RoleRequest $request)
    {
        try{
            $service = new BannerService(Role::class);
            $service = $service->store($request);
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('roles.index') : '']);
        }catch(\Exception $e){
            if ($e instanceof RoleAlreadyExists ) {
                // Handle ModelNotFoundException specifically
                return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
            } else {
                // Handle other exceptions generically
                return response()->json(['status'=>401,'msg'=>$e->getMessage(),'url'=>'']);
            }
        }
    }
    public function update(RoleRequest $request)
    {
        $service = new BannerService(Role::class);
        $service = $service->update($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('roles.index') : '']);
    }
    public function updateRolePermission(Request $request)
    {
        $role = Role::find($request->id);
        $role->syncPermissions($request->input('permission'));
        return response()->json(['status'=>200,'msg'=>'Action performed successfully','url'=>route('roles.index')]);
    }
    public function delete($id,RoleRequest $request)
    {
        $service = new BannerService(Role::class);
        $service = $service->delete($id);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('roles.index') : '']);
    }
}
