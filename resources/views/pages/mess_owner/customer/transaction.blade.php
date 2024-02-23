@extends('pages.layout.layout')
@section('title','Mess App | View Transaction')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">View Transaction</h2>
                </div>
            </div>
            <form id="viewTransactionForm" method="POST" action="{{ route('mess_owner.customer.filter.transaction')  }}" enctype="multipart/form-data">
                @csrf
                <div class="col">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="form-label">Customer</label>
                                <select class="form-control" name="user_id">
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
                            <label class="form-label">Transaction Type</label>
                            <select class="form-control" name="transaction_type">
                                <option value="">Select Transaction Type</option>
                                <option value="debit">Debit</option>
                                <option value="credit">Credit</option>
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
                @include('pages.common.transaction_data')
            </div>
        </div>
    </div>
</main>
@section('page_scripts')
<script>
    $(function(){
        $("body").on('submit','#viewTransactionForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#viewTransactionForm')[0];
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                $(".attendance_data").html(d.html);
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
    });
</script>
@endsection
@endsection
