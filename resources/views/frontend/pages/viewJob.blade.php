@extends('frontend.layout.master')
@section('title','Mess App | Home Page')
@section('content')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_home.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>{{ $singleJob->title }}</h1>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

            <div id="position">
                <div class="container">
                    <ul>
                        <li><a href=""{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('job.list') }}">Jobs</a></li>
                        <li>Blogs</li>
                    </ul>
                </div>
            </div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row">
        <div class="col-md-9">
            <div class="post">
                <h2>{{ $singleJob->title }}</h2>
                <p>
                    {!!  $singleJob->description !!}
                </p>
            </div>
            <h4>Apply for this Job</h4>
            <form action="{{ route('apply.job') }}" method="post" id="applyForm">
                <div class="form-group">
                    <input class="form-control styled" type="text" name="name" placeholder="Enter name">
                    <input class="form-control styled" type="hidden" name="job_id" placeholder="Enter Name" value="{{ $singleJob->id }}">
                </div>
                <div class="form-group">
                    <input class="form-control styled" type="text" name="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <input class="form-control styled" type="text" name="phone" placeholder="Enter Phone">
                </div>
                <div class="form-group">
                    <textarea name="about" class="form-control styled" style="height:150px;" placeholder="About yourself"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn_1" value="Apply">
                </div>
            </form>
        </div>
    </div>
</div><!-- End container -->
@endsection
@section('page_script')
<script>
    $(function(){
        $("body").on('submit','#applyForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#applyForm')[0];
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(function(){
                        window.location = d.url;
                    },1000);
                }else{
                    CommonLib.notification.error(d.errors);
                }
            }).catch(e=>{
                const error = JSON.parse(e.responseText);
                CommonLib.notification.error(error.errors);
            });
        });
    });
</script>
@endsection
