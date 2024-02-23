@extends('pages.layout.layout')
@section('title','Mess App | Manage Payment')
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
                    <h5 class="mb-0">Manage Payment</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="paymentForm" method="POST" action="{{ route('customer.payment.request.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="amount" placeholder="Amount">
                            <input type="hidden" class="form-control" name="user_id" placeholder="Amount" value="{{ auth()->user()->id}}">
                            <input type="hidden" class="form-control" name="mess_id" placeholder="Amount" value="{{ auth()->user()->mess_id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Payment Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="payment_date" placeholder="Payment Date">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Reference Screenshot <small>(png,jpeg,jpg)</small></label>
                            <input type="file" class="form-control" name="reference_screenshot">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Payment Mode </label>
                            <select class="form-control" name="payment_mode">
                                <option value="">Select Payment Mode</option>
                                <option value="cash">Cash</option>
                                <option value="online">Online</option>
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
        $("body").on('submit','#paymentForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#paymentForm')[0]; // You need to use standard javascript object here
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
        $("body").on("click",'.payment_status',function(e){
            var currentWrapper = $(this);
            const food_type = currentWrapper.val();
            switch (food_type) {
                case 'paid':
                    $(".payment_screenshot").removeClass('d-none');
                    break;
                case 'unpaid':
                    $(".payment_screenshot").addClass('d-none');
                    break;
                default:
                    break;
            }
        });
    });
</script>
@endsection
@endsection
