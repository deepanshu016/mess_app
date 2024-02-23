@extends('pages.layout.layout')
@section('title','Mess App | Payment Requests')
@section('content')
@section('page_styles')
<style>
    td.word-break-class {
        word-break: break-all;
    }
</style>
@endsection
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Payment Requests</h2>
                </div>
                <div class="right-part">
                    <a href="{{ route('customer.payment.request.create') }}" class="btn btn-primary btn-sm rounded-1"><i class="bi bi-plus-circle"></i>  Add New </a>
                </div>
            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Payment Requests</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="paymentList" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Screenshot</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('page_scripts')
<script>
    $(function(){
        $('#paymentList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('common.payment.request.datatables') }}" + "?user_id=" + {{ Auth::user()->id }},
                type: 'GET',
            },
            columns: [
                {
                    data: 'name',
                    name: 'Name',
                    render:function(data, type, row, meta){
                        return row.user.name;
                    }
                },
                {
                    data: 'amount',
                    name: 'Amount',
                    render:function(data, type, row, meta){
                        return (row.amount) ? `INR ${parseFloat(row.amount)}` : `INR 0.00`;
                    }
                },
                {
                    data: 'screenshot',
                    name: 'Screenshot',
                    render:function(data, type, row, meta){
                        var media = '';
                        if(row.media.length > 0){
                            media += `<i class="bi bi-paperclip"></i> <a href="${row.medias}" class="text-primary mb-3" download="${row.medias}">${row.media[0].uuid}</a>`;
                        }else{
                            media += '-';
                        }
                        return media;
                    }
                },
                {
                    data: 'status',
                    name: 'Status',
                    render:function(data, type, row, meta){
                        if(row.status === 'pending'){
                            return '<h6 class="fw-semibold text-warning mb-0"><span class="indicator bg-warning"></span> Pending</h6>';
                        }
                        if(row.status === 'accept'){
                            return '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> Accepted</h6>';
                        }
                        if(row.status === 'rejected'){
                            return '<h6 class="fw-semibold text-danger mb-0"><span class="indicator bg-danger"></span> Rejected</h6>';
                        }
                    }
                },
                {
                    data: 'date',
                    name: 'Date',
                    render:function(data, type, row, meta){
                        return new Date(row.payment_date).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });
                    }
                },
                {
                    data: 'id',
                    name: 'Action',
                    render:function(data, type, row, meta){
                        return `<a href="${row.id}/view" class="btn-video square btn btn-outline-primary rounded-2 px-0 py-0 me-3"><i class="bi bi-eye"></i></a>`;
                    }
                }
            ],
            language: {
                search: '<i class="bi bi-search"></i>',
                searchPlaceholder: "Search here",
                paginate: {
                next: '<i class="bi bi-chevron-right"></i>',
                previous: '<i class="bi bi-chevron-left"></i>'
                }
            },
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            rowId:'id'
        });
    });
</script>
@endsection
