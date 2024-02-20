@extends('pages.layout.layout')
@section('title','Mess App | Mark Attendance')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Mark Attendance</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Mark Attendance</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="attendanceForm" method="POST" action="{{ route('mess_owner.customer.mark.attendance')  }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <p>{{ @$customer->name}}</p>
                            <input type="hidden" class="form-control" name="customer_id" value="{{ @$customer->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <p>{{ @$customer->email}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone </label>
                            <p>{{ @$customer->phone}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Wallet Balance</label>
                            <p>INR {{ ($customer->payment) ? @number_format(count_total_attend_days($customer->id,$customer->mess_id)) : 0.0}}</p>
                        </div>
                        <div class="form-group payment_screenshon">
                            <label class="form-label">Marking Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="attendance_start" value="{{ date('Y-m-d',strtotime($customer->payments->payment_date)) }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($customer)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#attendanceForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#attendanceForm')[0]; // You need to use standard javascript object here
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
