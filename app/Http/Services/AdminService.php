<?php
namespace App\Http\Services;
use App\Http\Services\MediaService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminService {

    public $model;
    public $media;
    public function __construct($model){
        $this->model = $model;
        $this->media = new MediaService();
    }
    public function list($request,$conditions=[],$relations=[]){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $lists = $this->model::whereHas('roles', function ($query) {
            $query->whereNotIn('name', ['ADMIN', 'MESS_OWNER', 'CUSTOMER']);
        });
        $lists =  $lists->where(function ($query) use ($searchValue,$request){
            $filters = $request->input('params');
            if ($filters) {
                foreach ($filters as $filter) {
                    $query->orWhere($filter,'like','%'. $searchValue . '%');
                }
            }
        });
        if(!empty($conditions)){
            $lists = $lists->where($conditions);
        }
        $totalRecords = $lists->count();
        $lists = $lists->offset($request->input('start'))->limit($request->input('length'));
        $lists = $lists->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $lists;
        return $listData;
    }
    public function edit($banner_id,$relation){
        return $this->model::with($relation)->find($banner_id);
    }
    public function getAll(){
        return $this->model::all();
    }
    public function getList($conditions){
        return $this->model::where($conditions)->get();
    }
    public function filter(Object $request){
        $transaction = $this->model::with(['user','mess_owner']);
        if($request->mess_id){
            $transaction = $transaction->where('mess_id',$request->mess_id);
        }
        if($request->transaction_type){
            $transaction = $transaction->where('transaction_type',$request->transaction_type);
        }
        if($request->month){
            $transaction = $transaction->whereMonth('transaction_date',$request->month);
        }
        $transaction = $transaction->orderBy('transaction_date','DESC')->get();
        return $transaction;
    }
    public function store(Object $request,$file_name = '',$file_tag=''){

        $banner = $this->model::create($request->toArray());
        $banner = $this->model::find($banner->id);
        if($file_name != '' && $file_tag != ''){
            $uploaded = $this->media->store($file_name,$file_tag,$request,$banner);
        }
        return $banner;
    }
    public function update(Object $request,$file_name = '',$file_tag=''){

        $banner = $this->model::find($request->id);
        $banners = $banner->update($request->toArray());
        if($file_name != '' && $file_tag != ''){
            $uploaded = ($file_tag == 'GALLERY_MEDIA') ? $this->media->store($file_name,$file_tag,$request,$banner) : $this->media->update($file_name,$file_tag,$request,$banner);
        }
        return $banner;
    }
    public function delete($id,$file_tag = ''){
        $banner = $this->model::find($id);
        if($file_tag != ''){
            $this->media->delete($file_tag,$banner);
        }
        return $banner->delete();
    }
    public function deleteMedia(Object $request){
        $media = $this->model::find($request->id);
        return $media->delete();
    }



    public function storeAsArray($request){

        $banner = $this->model::create($request);
        $banner = $this->model::find($banner->id);
        return $banner;
    }
 }


?>
