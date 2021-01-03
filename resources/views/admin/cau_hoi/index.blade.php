{{-- resources/views/admin/dashboard.blade.php --}}

@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Danh sách câu hỏi: </h1>
@stop

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo</h4>
            {{ session('message') }}
        </div>
    @endif
    <div class="callout-top callout-top-danger col-md-12">
        <table id="data-table" align="center" width="100%"
               class="table table-hover table-striped table-bordered border">
            <thead>
            <tr class="bg-danger">
                <th>STT</th>
                <th>Nội dung</th>
                <th>Câu trả lời</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $key => $post)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$post->content}}</td>
                    @php
                        $abc = explode(',',$post->answers);
                    @endphp
                    <td>
                        <ol type="A">
                            @foreach($abc as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td><span class="text-success">Hiển thị</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@stop
