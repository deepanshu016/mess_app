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
            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Request Info</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table table-flex">
                        <div class="thead fw-bold border-bottom border-1 border-light-200">
                            <div class="row px-2">
                                <div class="col">#</div>
                                <div class="col">Customer Name</div>
                                <div class="col">Subject</div>
                                <div class="col">Description</div>
                                <div class="col">Status</div>
                                <div class="col">Request Submitted at</div>
                                <div class="col">Action</div>
                            </div>
                        </div>
                        <div class="tbody">
                            @if(!empty($data))
                                @foreach($data as $key=>$data)
                                    <div class="row px-2 border-bottom border-1 border-light-200">
                                        <div class="col">{{ $key+1}}</div>
                                        <div class="col">{{ $data->user->name}}</div>
                                        <div class="col">{{ $data->title}}</div>
                                        <div class="col" style="word-break: break-all;">{{ $data->description}}</div>
                                        <div class="col">{{ strtoupper($data->status)}}</div>
                                        <div class="col">{{ date('d M Y',strtotime($data->created_at)) }}</div>
                                        <div class="col">
                                            <a href="{{ route('mess_owner.request.view',['request_id'=>$data->id]) }}" class="btn btn-primary btn-sm rounded-1 btn-icon"><i class="bi bi-eye"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
