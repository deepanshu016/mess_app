<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MenuService;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\MarkDayRequest;
use App\Http\Services\MessOwnerService;
class MenuController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.mess_owner.menu.list');
    }
    public function add(Request $request)
    {
        $service = new MenuService();
        $mess = new MessOwnerService();
        $menu = $service->list($request);
        $cuisinesList = $mess->getMessCuisines();
        // echo "<pre>";
        // print_r(json_decode(json_encode($menu),true)); die;
        return view('pages.mess_owner.menu.create',compact('menu','cuisinesList'));
    }
    public function list(Request $request)
    {
        $service = new MenuService();
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($menu_id)
    {
        $service = new MenuService();
        $menu = $service->edit($menu_id);
        return view('pages.mess_owner.menu.create',compact('menu'));
    }
    public function save(MenuRequest $request)
    {
        try{
            $service = new MenuService();
            $service = $service->store($request);
            if($service){
                return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$service,'url'=>route('mess_owner.menu.create').'?menu='.((getMessOwner()->food_type == 'both') ? 'veg' : getMessOwner()->food_type)]);
            }
            return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function update(Request $request)
    {
        try{
            $service = new MenuService();
            $service = $service->update($request);
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.menu.create').'?menu='.((getMessOwner()->food_type == 'both') ? 'veg' : getMessOwner()->food_type) : '']);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
    public function delete($id)
    {
        $service = new MenuService();
        $service = $service->delete($id);
        if($service){
            return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>'','url'=>route('admin.mess_owner.list')]);
        }
        return response()->json(['status'=>400,'msg'=>'Something went wrong','data'=>[],'url'=>'']);
    }


    public function mark_day(Request $request)
    {
        return view('pages.customer.menu.create');
    }
    public function mark_day_list(Request $request)
    {
        return view('pages.customer.menu.list');
    }


    public function StoreAbsentDay(MarkDayRequest $request)
    {
        try{
            $service = new MenuService();
            $service = $service->StoreAbsentDay($request);
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('customer.menu.mark_day.list') : '']);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }

    public function markDays(Request $request)
    {
        $service = new MenuService();
        $data = $service->markDays($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
}
