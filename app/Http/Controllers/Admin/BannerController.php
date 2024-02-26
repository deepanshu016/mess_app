<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
class BannerController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.admin.banner.list');
    }
    public function add(Request $request)
    {
        return view('pages.admin.banner.create');
    }
    public function list(Request $request)
    {
        $service = new BannerService(Banner::class);
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($banner_id)
    {
        $service = new BannerService(Banner::class);
        $banner = $service->edit($banner_id);
        return view('pages.admin.banner.create',compact('banner'));
    }
    public function save(BannerRequest $request)
    {
        $service = new BannerService(Banner::class);
        $service = $service->store($request,'banner_image','BANNER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.banner.list') : '']);
    }
    public function update(BannerRequest $request)
    {
        $service = new BannerService(Banner::class);
        $service = $service->update($request,'banner_image','BANNER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.banner.list') : '']);
    }
    public function delete($id,BannerRequest $request)
    {
        $service = new BannerService(Banner::class);
        $service = $service->delete($id,'BANNER_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.banner.list') : '']);
    }
}
