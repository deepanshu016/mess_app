<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MessOwnerService;
use App\Http\Services\CustomerService;
use App\Http\Services\AuthService;
use App\Http\Services\PaymentService;
use App\Http\Services\SettingsService;
use App\Http\Services\MenuService;
use Illuminate\Support\Facades\View;

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
        $data['total_mess_owner'] = $service->getAllCount();
        $data['total_customer'] = $customer->getAllCustomer();
        $data['total_people_served'] = $payment->totalPeopleServed();
        $data['messList'] = $service->allMess($request,'DESC',6);
        return view('frontend.pages.home',$data);
    }
    public function messList(Request $request)
    {
        $service = new MessOwnerService();
        $data['messList'] = $service->allMess($request,'',1);
        $data['totalVegMess'] = $service->totalMess($request,'veg');
        $data['totalNonVegMess'] = $service->totalMess($request,'non_veg');
        $data['totalBothMess'] = $service->totalMess($request,'both');
        return view('frontend.pages.mess_list',$data);
    }
    public function loadMoreMess(Request $request)
    {
        $service = new MessOwnerService();
        $messList = $service->allMess($request,'DESC',1);
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
        $data['menuList'] = $menu->list($request,$mess_id);
        $data['singleMess'] = $mess->edit($mess_id);
        return view('frontend.pages.view_menu',$data);
    }
    public function bookAMess($mess_id,Request $request)
    {
        $menu = new MenuService();
        $mess = new MessOwnerService();
        $data['menuList'] = $menu->list($request,$mess_id);
        $data['singleMess'] = $mess->edit($mess_id);
        return view('frontend.pages.view_menu',$data);
    }
    public function messDetail($mess_id,Request $request)
    {
        $menu = new MenuService();
        $mess = new MessOwnerService();
        $data['menuList'] = $menu->list($request,$mess_id);
        $data['singleMess'] = $mess->edit($mess_id);
        return view('frontend.pages.mess_detail',$data);
    }
    public function aboutUs(Request $request)
    {
        return view('frontend.pages.about_us');
    }
    public function contactUs(Request $request)
    {
        return view('frontend.pages.contact_us');
    }
    public function profile(Request $request)
    {
        $service = new CustomerService();
        $customers = $service->customerList();
        $transaction = $service->filterTransaction($request);
        $auth = new AuthService();
        $user = $auth->getProfile();
        return view('frontend.pages.profile',compact('customers','transaction','user'));
    }
    public function BookingAMess(Request $request)
    {
        $customer = new CustomerService();
        $service = $customer->assignMess($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('view.profile') : '']);
    }
    public function transactionList(Request $request)
    {
        $service = new CustomerService();
        $data = $service->transactionDataTables($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
}
