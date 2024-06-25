<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use App\Http\Requests\NewsRequest;
use App\Models\News;
class NewsController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.admin.news.list');
    }
    public function add(Request $request)
    {
        return view('pages.admin.news.create');
    }
    public function list(Request $request)
    {
        $service = new BannerService(News::class);
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($news_id)
    {
        $service = new BannerService(News::class);
        $news = $service->edit($news_id);
        return view('pages.admin.news.create',compact('news'));
    }
    public function save(NewsRequest $request)
    {
        $service = new BannerService(News::class);
        $service = $service->store($request,'news_image','NEWS_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.news.list') : '']);
    }
    public function update(NewsRequest $request)
    {
        $service = new BannerService(News::class);
        $service = $service->update($request,'news_image','NEWS_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.news.list') : '']);
    }
    public function delete($id,NewsRequest $request)
    {
        $service = new BannerService(News::class);
        $service = $service->delete($id,'NEWS_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.news.list') : '']);
    }
}
