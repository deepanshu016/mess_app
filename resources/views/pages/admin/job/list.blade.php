@extends('pages.layout.layout')
@section('title','Mess App | List')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Jobs</h2>
                </div>
            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Jobs Info</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="jobsLists" class="display">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Vacant Seat</th>
                                    <th>Total Applications</th>
                                    <th>Description</th>
                                    <th>Status</th>
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
        var dynamicParam = ["title","vacant_seat","description"];
        $('#jobsLists').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.job.datatables') }}",
                type: 'GET',
                "data": {
                    "params": dynamicParam
                }
            },
            columns: [
                { data: 'title', name: 'Title' },
                {
                    data: 'vacant_seat',
                    name: 'Vacancy',
                    render:function(data, type, row, meta){
                        return row.vacant_seat;
                    }
                },
                {
                    data: 'applications',
                    name: 'Total Applications',
                    render:function(data, type, row, meta){
                        return `<a href="${row.id}/view-application">${row.applications}</a>`;
                    }
                },
                {
                    data: 'description',
                    name: 'Description',
                    render:function(data, type, row, meta){
                        return row.description;
                    }
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
                    data: 'id',
                    name: 'Action',
                    render:function(data, type, row, meta){
                        return `<a href="${row.id}/edit" class="btn-video square btn btn-outline-primary rounded-2 px-0 py-0 me-3"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0);" class="btn-video square btn btn-outline-danger rounded-2 px-0 py-0 me-3 delete" data-url="delete" data-id="${row.id}"><i class="bi bi-trash"></i></a>`;
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
            CommonLib.sweetalert.confirm(formData,'POST',url);
        });
    });
</script>
@endsection
