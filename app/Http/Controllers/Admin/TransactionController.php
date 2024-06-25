<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use App\Http\Services\CommonService;
use Illuminate\Support\Facades\View;
use App\Models\Transaction;
use App\Models\MessOwner;
use App\Traits\UtilsTrait;
class TransactionController extends Controller
{
    use UtilsTrait;
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        $service = new CommonService();
        $userDetails = $service->getProfile(['locationPreferences']);
        $locationPreferences = $this->getUserLocationPreferences($userDetails);
        $messOwner = $service->getAllMess($userDetails,$request,$locationPreferences);
        return view('pages.admin.transaction.list',compact('messOwner'));
    }
    public function filter(Request $request)
    {
        try{
            $service = new BannerService(Transaction::class);
            $transaction = $service->filter($request);
            $html = View::make('pages.common.transaction_data',['transaction'=>$transaction])->render();
            return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>'','html'=>$html]);
        }catch(\Exception $e){
            return response()->json(['status'=>400,'msg'=>$e->getMessage(),'url'=>'']);
        }
    }
}
