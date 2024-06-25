<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
class FaqController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.admin.faq.list');
    }
    public function add(Request $request)
    {
        return view('pages.admin.faq.create');
    }
    public function list(Request $request)
    {
        $service = new BannerService(Faq::class);
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($faq_id)
    {
        $service = new BannerService(Faq::class);
        $faq = $service->edit($faq_id);
        return view('pages.admin.faq.create',compact('faq'));
    }
    public function save(FaqRequest $request)
    {
        $service = new BannerService(Faq::class);
        $service = $service->store($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.faq.list') : '']);
    }
    public function update(FaqRequest $request)
    {
        $service = new BannerService(Faq::class);
        $service = $service->update($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.faq.list') : '']);
    }
    public function delete(FaqRequest $request)
    {
        $id = $request->id;
        $service = new BannerService(Faq::class);
        $service = $service->delete($id);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.faq.list') : '']);
    }
}
