<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MessOwnerService;
use App\Http\Services\CustomerService;
use App\Http\Services\MenuService;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $service = new MessOwnerService();
        $customer = new CustomerService();
        $data['total_mess_owner'] = $service->getAllCount();
        $data['total_customer'] = $customer->getAllCustomer();
        return view('frontend.pages.home',$data);
    }
    public function messList(Request $request)
    {
        $service = new MessOwnerService();
        $data['messList'] = $service->allMess($request);
        return view('frontend.pages.mess_list',$data);
    }
    public function loadMoreMess(Request $request)
    {
        $service = new MessOwnerService();
        $messList = $service->allMess($request);
        $html = View::make('frontend.common.mess_list',compact('messList'))->render();
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','html'=>$html]);
    }
    public function viewMenu($mess_id,Request $request)
    {
        $menu = new MenuService();
        $mess = new MessOwnerService();
        $data['menuList'] = $menu->list($request,$mess_id);
        $data['singleMess'] = $mess->edit($mess_id);
        // echo "<pre>";
        // print_r(json_decode(json_encode($data['menuList']),true)); die;
        return view('frontend.pages.view_menu',$data);
    }
}
