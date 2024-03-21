<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MessOwnerService;
use App\Http\Services\CustomerService;
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
        return view('frontend.pages.mess_list',$data);
    }
    public function loadMoreMess(Request $request)
    {
        $service = new MessOwnerService();
        $messList = $service->allMess($request,'DESC',1);
        $html = View::make('frontend.common.mess_list',compact('messList'))->render();
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','html'=>$html]);
    }
    public function viewMenu($mess_id,Request $request)
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
        return view('frontend.pages.profile');
    }
}
