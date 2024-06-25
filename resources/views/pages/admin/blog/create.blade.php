@extends('pages.layout.layout')
@section('title','Mess App | Manage Banner')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($blog)) ? 'Add Blog' : 'Update Blog' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Banner</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="bannerForm" method="POST" action="{{ (empty($blog)) ? route('admin.blog.save') : route('admin.blog.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ @$blog->title}}">
                            <input type="hidden" class="form-control" name="id" placeholder="ID" value="{{ @$blog->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Blog Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="blog_image" accept="images/*">
                            @if(!empty($blog) && isset($blog->getMedia("BLOG_IMAGE")[0]))
                                <img src="{{ asset('public/media/').'/'.$blog->getMedia("BLOG_IMAGE")[0]->id.'/'.$blog->getMedia("BLOG_IMAGE")[0]->file_name }}" width="100" height="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control full_description" id="answer" name="description" rows="4" cols="50" placeholder="Description">{{ @$blog->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="active" {{ (isset($blog) && ($blog->status  == 'active')) ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{ (isset($blog) && ($blog->status  == 'inactive')) ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($blog)) ? 'Update' : 'Save' }}</button>
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
        const types = ['answer'];
        function createEditor(elementId) {
            ClassicEditor.create(document.querySelector(elementId)).then(editor => {
                    console.log(editor);
            }).catch(error => {
                    console.error(error);
            });
        }
        types.forEach(day => {
            createEditor(`#${day}`);
        });
    });
</script>
@endsection
@endsection
