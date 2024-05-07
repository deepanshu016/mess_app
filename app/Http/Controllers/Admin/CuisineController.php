<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use Spatie\Permission\Models\Role;
use App\Http\Requests\CuisineRequest;
use App\Models\UserLocation;
use App\Models\Cuisine;
use App\Models\State;
use App\Models\User;
use App\Models\City;
class CuisineController extends Controller
{

    public function __construct(){
        // $this->middleware(['permission:cuisines-create|cuisines-delete|cuisines-update|cuisines-list']);
    }

    public function index(Request $request)
    {
        return view('pages.admin.cuisine.list');
    }
    public function add(Request $request)
    {
        $service = new BannerService(Cuisine::class);
        $cuisineList = $service->getAll($request);
        return view('pages.admin.cuisine.create',compact('cuisineList'));
    }
    public function list(Request $request)
    {
        $service = new BannerService(Cuisine::class);
        $data = $service->list($request,[],[]);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($cuisine_id,Request $request)
    {
        $service = new BannerService(Cuisine::class);
        $singleCuisine = $service->edit($cuisine_id);
        return view('pages.admin.cuisine.create',compact('singleCuisine'));
    }
    public function save(CuisineRequest $request)
    {
        $service = new BannerService(Cuisine::class);
        $service = $service->store($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.cuisines.list') : '']);
    }
    public function update(CuisineRequest $request)
    {
        $service = new BannerService(Cuisine::class);
        $service = $service->update($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.cuisines.list') : '']);
    }
    public function delete($id,Request $request)
    {
        $service = new BannerService(Cuisine::class);
        $service = $service->delete($id);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.cuisines.list') : '']);
    }
}
