@extends('pages.layout.layout')
@section('title','Mess App | Customers List')
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
                    <div class="col">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Mess</label>
                                    <select class="form-control mess_id" name="mess_id">
                                        <option value="">Select Mess</option>
                                        @if(!empty($messList))
                                            @foreach ($messList as $mess)
                                                <option value="{{ $mess->id }}">{{ $mess->mess_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="messOwnerLists" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mess Name</th>
                                    <th>Wallet Amount</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Meal Type</th>
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

    var mess_id = '';
    $(function(){
        var table = $('#messOwnerLists').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.customer.datatables') }}",
                type: 'GET',
                data: function (d) {
                    d.mess_id = mess_id;
                }
            },
            columns: [
                { data: 'name', name: 'Name' },
                {
                    data: 'mess_name',
                    name: 'Mess Name',
                    render:function(data, type, row, meta){
                        return (row.mess_owner) ? row.mess_owner.mess_name : '';
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
                    data: 'status',
                    name: 'Status',
                    render:function(data, type, row, meta){
                        var status = '';
                        if(row.status == 'active'){
                            status = '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> ACTIVE</h6>';
                        }else{
                            status = '<h6 class="fw-semibold text-danger mb-0"><span class="indicator bg-danger"></span> INACTIVE</h6>'
                        }
                        return status;
                    }
                },
                {
                    data: 'meal_type',
                    name: 'Meal Type',
                    render:function(data, type, row, meta){
                        return (row.meal_type == 'veg') ? 'Veg' : 'Non Veg';
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
        $("body").on("change",'.mess_id',function(){
            var mess_ids = $(this).val();
            if(mess_ids){
                mess_id = mess_ids;
                table.ajax.reload();
            }
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
