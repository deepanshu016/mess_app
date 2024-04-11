<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Http\Services\CommonService;
use App\Http\Services\MessOwnerService;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Traits\UtilsTrait;
use App\Http\Services\AdminService;
class CustomerController extends Controller
{
    use UtilsTrait;
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        $service = new MessOwnerService();
        $messList = $service->messOwner();
        return view('pages.admin.customer.list',compact('messList'));
    }
    public function list(Request $request)
    {

        $service = new CommonService();
        $userDetails = $service->getProfile(['locationPreferences']);
        $locationPreferences = $this->getUserLocationPreferences($userDetails);
        $data = $service->listForAdmin($userDetails,$request,$locationPreferences);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
}
