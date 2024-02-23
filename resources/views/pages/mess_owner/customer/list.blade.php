@extends('pages.layout.layout')
@section('title','Mess App | List')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Customers List</h2>
                </div>

            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Customers List</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="messOwnerLists" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Wallet Amount</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Meal Type</th>
                                    <th>Wallet</th>
                                    <th>Transaction</th>
                                    <th>Action</th>
                                    <th></th>
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
        $('#messOwnerLists').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('mess_owner.customer.datatables') }}",
                type: 'GET',
            },
            columns: [
                { data: 'name', name: 'Name' },
                {
                    data: 'wallet_amount',
                    name: 'Wallet Amount',
                    render:function(data, type, row, meta){
                        return (row.payment) ? `INR ${parseFloat(row.payment)}` : `INR 0.00`;
                    }
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'meal_type',
                    name: 'Meal Type',
                    render:function(data, type, row, meta){
                        return (row.meal_type == 'veg') ? 'Veg' : 'Non Veg';
                    }
                },
                {
                    data: 'subscription',
                    name: 'Subscription',
                    render:function(data, type, row, meta){
                        return `<a href="${row.id}/manage-subscription" class="bg-primary text-white fs-12 lh-26 text-uppercase px-2 rounded-4 float-end">Refill</a>`;
                    }
                },
                {
                    data: 'transaction',
                    name: 'Transaction',
                    render:function(data, type, row, meta){
                        return `<a href="${row.id}/mark-customer-attendance" class="bg-success text-white fs-12 lh-26 text-uppercase px-5 rounded-4 float-end">Add New</a>
                        <a href="/mess-owner/customer/transaction?user_id=${row.id}" class="bg-warning text-white fs-12 lh-26 text-uppercase px-5 rounded-4 float-end">View</a>`;
                    }
                },
                {
                    data: 'id',
                    name: 'Action',
                    render:function(data, type, row, meta){
                        return `<a href="${row.id}/edit" class="btn-video square btn btn-outline-primary rounded-2 px-0 py-0 me-3"><i class="bi bi-pencil"></i></a>
                            <a href="javascript:void(0);" class="btn-video square btn btn-outline-danger rounded-2 px-0 py-0 me-3 delete" data-url="${row.id}/delete" data-id=""><i class="bi bi-trash"></i></a>`;
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
        $("body").on("click",'.delete',function(e){
            e.preventDefault();
            var formData = new FormData();
            var id = $(this).data("id");
            var url = $(this).data("url");
            formData.append('id',id);
            CommonLib.sweetalert.confirm(formData,'DELETE',url);
        });
    });
</script>
@endsection
