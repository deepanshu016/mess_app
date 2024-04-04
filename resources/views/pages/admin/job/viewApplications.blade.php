@extends('pages.layout.layout')
@section('title','Mess App | List')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Job Applications</h2>
                </div>
            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Job Applications</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="applicationList" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Attachment</th>
                                    <th>Application Date</th>
                                    <th>About</th>
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
        var dynamicParam = ["name","email","about"];
        $('#applicationList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.job.application.datatables',['job_id'=>$job_id]) }}",
                type: 'GET',
                "data": {
                    "params": dynamicParam
                }
            },
            columns: [
                { data: 'name', name: 'Name' },
                {
                    data: 'phone',
                    name: 'Phone',
                    render:function(data, type, row, meta){
                        return (row.phone) ? row.phone : '';
                    }
                },
                {
                    data: 'email',
                    name: 'Email',
                    render:function(data, type, row, meta){
                        return row.email;
                    }
                },
                {
                    data: 'attachement',
                    name: 'Attachement',
                    render:function(data, type, row, meta){
                        if(row.medias){
                            return `<a href="${row.medias}" download>${row.media[0].uuid}</a>`;
                        }else{
                            return 'Not uploaded';
                        }
                    }
                },
                {
                    data: 'date',
                    name: 'Date',
                    render:function(data, type, row, meta){
                        return new Date(row.created_at).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });
                    }
                },
                {
                    data: 'about',
                    name: 'About',
                    render:function(data, type, row, meta){
                        return row.about;
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
