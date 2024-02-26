@extends('pages.layout.layout')
@section('title','Mess App | List')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">FAQs</h2>
                </div>
            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">FAQs Info</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="faqLists" class="display">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
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
        var dynamicParam = ["question","answer"];
        $('#faqLists').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.faq.datatables') }}",
                type: 'GET',
                "data": {
                    "params": dynamicParam
                }
            },
            columns: [
                { data: 'question', name: 'Question' },
                {
                    data: 'answer',
                    name: 'Answer',
                    render:function(data, type, row, meta){
                        return CommonLib.truncateString(row.answer,100);
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
        $("body").on("click",'.change-password',function(e){
            e.preventDefault();
            var user_id = $(this).data('id');
            $("#changePasswordModal").find('.user_id').val(user_id);
        });
        $("body").on('submit','#changePasswordFrom',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#changePasswordFrom')[0];
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }else{
                    CommonLib.notification.error(d.errors);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
    });
</script>
@endsection
