<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\BannerService;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\ApplyJob;
class JobController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        return view('pages.admin.job.list');
    }
    public function add(Request $request)
    {
        return view('pages.admin.job.create');
    }
    public function list(Request $request)
    {
        $service = new BannerService(Job::class);
        $data = $service->list($request);
        if(!empty($data['data'])){
            foreach($data['data'] as $job){
                $job->applications = ApplyJob::where('job_id',$job->id)->count();
            }
        }
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function applicationList($job_id,Request $request)
    {
        $service = new BannerService(ApplyJob::class);
        $data = $service->list($request,['job_id'=>$job_id]);
        return response()->json(['status'=>200,'msg'=>'Action performed successfully !!','data'=>$data['data'],'draw'=>$data['draw'],'recordsTotal'=>$data['recordsTotal'],'recordsFiltered' => $data['recordsFiltered']]);
    }
    public function edit($job_id)
    {
        $service = new BannerService(Job::class);
        $job = $service->edit($job_id);
        return view('pages.admin.job.create',compact('job'));
    }
    public function viewApplications($job_id)
    {
        return view('pages.admin.job.viewApplications',compact('job_id'));
    }
    public function save(JobRequest $request)
    {
        $service = new BannerService(Job::class);
        $service = $service->store($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.job.list') : '']);
    }
    public function update(JobRequest $request)
    {
        $service = new BannerService(Job::class);
        $service = $service->update($request);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.job.list') : '']);
    }
    public function delete(JobRequest $request)
    {
        $id = $request->id;
        $service = new BannerService(Job::class);
        $service = $service->delete($id);
        return response()->json(['status'=>($service) ? 200 : 400,'msg'=>($service) ? 'Action performed successfully' : 'Something went wrong','url'=>($service) ? route('admin.job.list') : '']);
    }
}
