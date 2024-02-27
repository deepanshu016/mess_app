<?php

namespace App\Http\Controllers\MessOwner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
class GalleryController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.mess_owner.gallery.list');
    }
    public function add(Request $request)
    {
        return view('pages.mess_owner.gallery.create');
    }
    public function list(Request $request)
    {
        $service = new BannerService(Gallery::class);
        $data = $service->list($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($gallery_id)
    {
        $service = new BannerService(Gallery::class);
        $gallery = $service->edit($gallery_id);
        return view('pages.mess_owner.gallery.create',compact('gallery'));
    }
    public function save(GalleryRequest $request)
    {
        $service = new BannerService(Gallery::class);
        $service = $service->store($request,'medias','GALLERY_MEDIA');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.gallery.list') : '']);
    }
    public function update(GalleryRequest $request)
    {

        $service = new BannerService(Gallery::class);
        $service = $service->update($request,'medias','GALLERY_MEDIA');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.gallery.list') : '']);
    }
    public function delete($id,GalleryRequest $request)
    {
        $service = new BannerService(Gallery::class);
        $service = $service->delete($id,'GALLERY_MEDIA');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.gallery.list') : '']);
    }
}
