@extends('pages.layout.layout')
@section('title','Mess App | View Attendance')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">View Attendance</h2>
                </div>
            </div>
            <form id="viewAttendanceForm" method="POST" action="{{ route('mess_owner.customer.filter.attendance')  }}" enctype="multipart/form-data">
                @csrf
                <div class="col">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label">Customer</label>
                                <select class="form-control" name="customer_id">
                                    <option value="">Select Customer</option>
                                    @if(!empty($customers))
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}({{ $customer->email }})</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label class="form-label">Month</label>
                            <select class="form-control" name="month">
                                <option value="">Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-5">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="attendance_data">
                {{-- <div class="card border-0">
                    <div class="card-header bg-transparent border-0 p-5 pb-0">
                        <h5 class="mb-0">View Attendance</h5>
                    </div>
                    <div class="card-body pt-3"></div>
                </div> --}}
            </div>
        </div>
    </div>
</main>
@section('page_scripts')
<script>
    $(function(){
        $("body").on('submit','#viewAttendanceForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#viewAttendanceForm')[0]; // You need to use standard javascript object here
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                $(".attendance_data").html(d.html);
                // if(d.status === 200){
                //     CommonLib.notification.success(d.msg);
                //     setTimeout(() => {
                //         window.location = d.url;
                //     }, 1000);
                // }else{
                //     CommonLib.notification.error(d.msg);
                // }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
    });
</script>
@endsection
@endsection
