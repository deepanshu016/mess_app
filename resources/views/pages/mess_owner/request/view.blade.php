@extends('pages.layout.layout')
@section('title','Mess App | Manage Requests')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($customer)) ? 'Add Request' : 'Update Request' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Request</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="updateRequestForm" method="POST" action="{{ route('mess_owner.request.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Customer Name </label>
                            <input type="hidden" class="form-control" name="request_id" value="{{ @$requestData->id}}">
                            <p>{{ @$requestData->user->name}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Customer Email </label>
                            <p>{{ @$requestData->user->email}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject </label>
                            <p>{{ @$requestData->subject}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description </label>
                            <p>{{ @$requestData->description}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status </label>
                            <p>{{ @strtoupper($requestData->status)}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">requestData SUbmitted at</label>
                            <p>{{ date('d M Y H:i A',strtotime($requestData->created_at)) }}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mark Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="accepted">Accept</option>
                                <option value="updateRequestForm">Reject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@section('page_scripts')
<script>
    $(function(){
        $("body").on('submit','#updateRequestForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#updateRequestForm')[0]; // You need to use standard javascript object here
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(() => {
                        window.location = d.url;
                    }, 1000);
                }else{
                    CommonLib.notification.error(d.msg);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
    });
</script>
@endsection
@endsection
