@extends('pages.layout.layout')
@section('title','Mess App | List')
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
                    <h2 class="text-dark">Request</h2>
                </div>
                <div class="right-part">
                    <a href="{{ route('customer.request.create') }}" class="btn btn-primary btn-sm rounded-1"><i class="bi bi-plus-circle"></i>  Add New </a>
                </div>
            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Request Info</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="requestList" class="display">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Updated at</th>
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
        $('#requestList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('customer.request.datatables') }}",
                type: 'GET',
            },
            columns: [
                {
                    data: 'title',
                    name: 'Subject',
                    render:function(data, type, row, meta){
                        return row.title;
                    }
                },
                {
                    data: 'description',
                    name: 'Description',
                    class:'word-break-class'
                },
                {
                    data: 'status',
                    name: 'Status',
                    render:function(data, type, row, meta){
                        return row.status.toUpperCase();
                    }
                },
                {
                    data: 'updated_at',
                    name: 'Updated at',
                    render:function(data, type, row, meta){
                       if(row.status != 'pending'){
                        return new Date(row.updated_at).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });
                       }else{
                        return '';
                       }
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
