<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MessOwnerService;
use App\Http\Services\CustomerService;
use App\Http\Services\AuthService;
use App\Http\Services\PaymentService;
use App\Http\Services\SettingsService;
use App\Http\Services\MenuService;
use App\Http\Services\BannerService;
use Illuminate\Support\Facades\View;
use App\Http\Requests\JobRequest;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Job;
use App\Models\ApplyJob;
use App\Models\User;
use App\Models\Faq;
use Jorenvh\Share\ShareFacade;
class HomeController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        $service = new MessOwnerService();
        $customer = new CustomerService();
        $payment = new PaymentService();
        $banner = new BannerService(Banner::class);
        $data['total_mess_owner'] = $service->getAllCount();
        $data['total_customer'] = $customer->getAllCustomer();
        $data['bannerList'] = $banner->getAll();
        $data['total_people_served'] = $payment->totalPeopleServed();
        $data['messList'] = $service->allMess($request,'DESC',100);
        return view('frontend.pages.home',$data);
    }
    public function messList(Request $request)
    {
        $service = new MessOwnerService();
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['messList'] = $service->allMess($request,'',10);
        $data['totalVegMess'] = $service->totalMess($request,'veg');
        $data['totalNonVegMess'] = $service->totalMess($request,'non_veg');
        $data['totalBothMess'] = $service->totalMess($request,'both');
        $data['params'] = $request->params;
        return view('frontend.pages.mess_list',$data);
    }
    public function blogList(Request $request)
    {
        $service = new BannerService(Blog::class);
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['blogList'] = $service->getAll();
        $data['recentBlogs'] = Blog::orderBy('id','DESC')->limit(6)->get();
        return view('frontend.pages.blogs',$data);
    }
    public function jobList(Request $request)
    {
        $service = new BannerService(Job::class);
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['jobList'] = $service->getAll();
        return view('frontend.pages.jobs',$data);
    }
    public function faqs(Request $request)
    {
        $service = new BannerService(Faq::class);
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['faqList'] = $service->getAll();
        return view('frontend.pages.faqs',$data);
    }
    public function getJob($job_id,Request $request)
    {
        $service = new BannerService(Job::class);
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['singleJob'] = $service->edit($job_id);
        return view('frontend.pages.viewJob',$data);
    }
    public function applyForJob(JobRequest $request)
    {
        $service = new BannerService(ApplyJob::class);
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $service = $service->store($request,'job_attachement','JOB_ATTACHEMENT');
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('job.list') : '']);
    }
    public function loadMoreMess(Request $request)
    {
        $service = new MessOwnerService();
        $messList = $service->allMess($request,'DESC',10);
        $html = View::make('frontend.common.mess_list',compact('messList'))->render();
        $html2 = '';
        if($messList->currentPage() < $messList->lastPage()){
            $html2 = '<a href="javascript:void(0);" id="load-more" onclick="loadMore()" class="load_more_bt wow fadeIn">
                    Load more...
                    <div class="spinner-grow"  style="display:none;height: 17px;width: 17px;color: #78cfcf !important;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </a>';
        }
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','html'=>$html,'html2'=>$html2]);
    }
    public function viewMenu($mess_id,Request $request)
    {
        $menu = new MenuService();
        $mess = new MessOwnerService();
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['menuList'] = $menu->list($request,$mess_id);
        $data['singleMess'] = $mess->edit($mess_id);
        return view('frontend.pages.view_menu',$data);
    }
    public function bookAMess($mess_id,Request $request)
    {
        $menu = new MenuService();
        $mess = new MessOwnerService();
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['menuList'] = $menu->list($request,$mess_id);
        $data['singleMess'] = $mess->edit($mess_id);
        return view('frontend.pages.view_menu',$data);
    }
    public function messDetail($mess_id,Request $request)
    {
        $menu = new MenuService();
        $mess = new MessOwnerService();
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        $data['menuList'] = $menu->list($request,$mess_id);
        $data['singleMess'] = $mess->edit($mess_id);
        return view('frontend.pages.mess_detail',$data);
    }
    public function aboutUs(Request $request)
    {
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        return view('frontend.pages.about_us',$data);
    }
    public function contactUs(Request $request)
    {
        $banner = new BannerService(Banner::class);
        $data['bannerList'] = $banner->getAll();
        return view('frontend.pages.contact_us',$data);
    }
    public function profile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if($user->hasRole('CUSTOMER')){
            $service = new CustomerService();
            $customers = $service->customerList();
            $transaction = $service->filterTransaction($request);
            $auth = new AuthService();
            $user = $auth->getProfile();
            $shareButtons = ShareFacade::page(
                $user->referral_code,
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();
            return view('frontend.pages.profile',compact('shareButtons','customers','transaction','user'));
        }elseif($user->hasRole('MESS_OWNER')){
            return redirect(route('mess_owner.dashboard'));
        }else{
            return redirect(route('admin.dashboard'));
        }
    }
    public function BookingAMess(Request $request)
    {

        $customer = new CustomerService();
        $service = $customer->assignMess($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('view.profile') : '']);
    }
    public function BookingAMessPage($mess_id,Request $request)
    {
        $customer = new MessOwnerService();
        $messDetail = $customer->edit($mess_id);
        $html = view('frontend.common.book_a_mess_page',compact('messDetail'))->render();
        return response()->json(['status'=>($messDetail) ? 200 : 400,'msg'=>($messDetail) ? 'Action performed successfully' : 'Something went wrong','html'=>$html]);
    }
    public function transactionList(Request $request)
    {
        $service = new CustomerService();
        $data = $service->transactionDataTables($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
}
