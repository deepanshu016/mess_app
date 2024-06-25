<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Services\CustomerService;
use App\Http\Services\PaymentService;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.common.payment.list');
    }
    public function add(Request $request)
    {
        return view('pages.customer.payments.create');
    }
    public function list(Request $request)
    {
        $service = new PaymentService();
        $data = $service->paymentRequestLists($request);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function viewRequestsPage(Request $request)
    {
        return view('pages.mess_owner.payment.list');
    }
    public function editRequestPage($payment_id)
    {
        $service = new PaymentService();
        $payment = $service->edit($payment_id);

        return view('pages.mess_owner.payment.view',compact('payment'));
    }
    public function save(PaymentRequest $request)
    {
        $service = new PaymentService();
        $data = $service->store($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('customer.payment.request.list') : '']);
    }
    public function updatePaymentRequest(PaymentRequest $request)
    {
        $service = new PaymentService();
        $data = $service->update($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('mess_owner.payment.view.requests') : '']);
    }
}
