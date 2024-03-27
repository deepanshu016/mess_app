<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
class BlogController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.admin.blog.list');
    }
    public function add(Request $request)
    {
        return view('pages.admin.blog.create');
    }
    public function list(Request $request)
    {
        $service = new BannerService(Blog::class);
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($blog_id)
    {
        $service = new BannerService(Blog::class);
        $blog = $service->edit($blog_id);
        return view('pages.admin.blog.create',compact('blog'));
    }
    public function save(BlogRequest $request)
    {
        $service = new BannerService(Blog::class);
        $service = $service->store($request,'blog_image','BLOG_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.blog.list') : '']);
    }
    public function update(BlogRequest $request)
    {
        $service = new BannerService(Blog::class);
        $service = $service->update($request,'blog_image','BLOG_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.blog.list') : '']);
    }
    public function delete($id,Request $request)
    {
        $service = new BannerService(Blog::class);
        $service = $service->delete($id,'BLOG_IMAGE');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.blog.list') : '']);
    }
}
