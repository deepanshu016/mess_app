@extends('pages.layout.layout')
@section('title','Mess App | Manage News')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($news)) ? 'Add News' : 'Update News' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">News</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="newsForm" method="POST" action="{{ (empty($news)) ? route('admin.news.save') : route('admin.news.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ @$news->title}}">
                            <input type="hidden" class="form-control" name="id" placeholder="ID" value="{{ @$news->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">News Image</label>
                            <input type="file" class="form-control" name="news_image" accept="images/*">
                            @if(!empty($news) && isset($news->getMedia("NEWS_IMAGE")[0]))
                                <img src="{{ asset('public/media/').'/'.$news->getMedia("NEWS_IMAGE")[0]->id.'/'.$news->getMedia("NEWS_IMAGE")[0]->file_name }}" width="100" height="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea class="form-control short_description" name="short_description" rows="4" cols="50" placeholder="Short Description">{!! @$news->short_description !!}</textarea>
                            <span class="short_description_count text-success">{!! (!empty($news) && $news->short_description != '') ? strlen($news->short_description).' / 250 characters' : '0 / 250 characters'  !!}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Full Description <span class="text-danger">*</span></label>
                            <textarea class="form-control full_description" id="full_description" name="full_description" rows="4" cols="50" placeholder="Full Description">{{ @$news->full_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="active" {{ (isset($news) && ($news->status  == 'active')) ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{ (isset($news) && ($news->status  == 'inactive')) ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($news)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#newsForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#newsForm')[0];
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
        const types = ['full_description'];
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
