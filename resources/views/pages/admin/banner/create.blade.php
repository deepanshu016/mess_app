@extends('pages.layout.layout')
@section('title','Mess App | Manage Advertisement')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($banner)) ? 'Add Advertisement' : 'Update Advertisement' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Advertisement</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="bannerForm" method="POST" action="{{ (empty($banner)) ? route('admin.banner.save') : route('admin.banner.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ @$banner->title}}">
                            <input type="hidden" class="form-control" name="id" placeholder="ID" value="{{ @$banner->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Banner <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="banner_image" accept="images/*">
                            @if(!empty($banner) && isset($banner->getMedia("BANNER_IMAGE")[0]))
                                <img src="{{ asset('public/media/').'/'.$banner->getMedia("BANNER_IMAGE")[0]->id.'/'.$banner->getMedia("BANNER_IMAGE")[0]->file_name }}" width="100" height="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Link <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="link" placeholder="Link" value="{{ @$banner->link}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="active" {{ (isset($banner) && ($banner->status  == 'active')) ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{ (isset($banner) && ($banner->status  == 'inactive')) ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($banner)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#bannerForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#bannerForm')[0];
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
    });
</script>
@endsection
@endsection
