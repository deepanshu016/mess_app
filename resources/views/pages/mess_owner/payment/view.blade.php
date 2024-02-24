@extends('pages.layout.layout')
@section('title','Mess App | Manage Payment Requests')
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
                    <form id="updatePaymentRequestsForm" method="POST" action="{{ route('mess_owner.payment.request.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Customer Name </label>
                            <input type="hidden" class="form-control" name="payment_id" value="{{ @$payment->id}}">
                            <p>{{ @$payment->user->name}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Customer Email </label>
                            <p>{{ @$payment->user->email}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Payment Mode  </label>
                            <p>{{ @strtoupper($payment->payment)}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Payment Date </label>
                            <p>{{ @date('d M Y',strtotime($payment->payment_date))}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Screenshot </label>
                            @if(!empty($payment->media[0]))
                                <p><i class="bi bi-paperclip"></i> <a href="{{ $payment->medias}}" class="text-primary mb-3" download="{{ $payment->medias}}">{{ (isset($payment->media[0])) ? $payment->media[0]->uuid : ''}}</a></p>
                            @else
                                <p>Not Uploaded</p>
                            @endif
                        </div>
                        @if($payment->status == 'pending')
                        <div class="form-group">
                            <label class="form-label">Mark Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="accept">Accept</option>
                                <option value="rejected">Reject</option>
                            </select>
                        </div>
                        @else
                            {!! ($payment->status == 'accept') ? '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> Accepted</h6>' : '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-danger"></span> Rejected</h6>' !!}
                        @endif
                        @if($payment->status == 'pending')
                            <div class="form-group">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@section('page_scripts')
<script>
    $(function(){
        $("body").on('submit','#updatePaymentRequestsForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#updatePaymentRequestsForm')[0]; // You need to use standard javascript object here
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
