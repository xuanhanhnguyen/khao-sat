{{-- resources/views/admin/dashboard.blade.php --}}

@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Danh sách bài khảo sát</h1>
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
            <tr class="bg-primary">
                <th class="text-center">Mã khảo sát</th>
                <th class="text-center">Tiêu đề</th>
                <th class="text-center">Mô tả</th>
                <th class="text-center">Đối tượng</th>
                <th class="text-center">Tác giả</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">
                    <button onclick="location.href = '/admin/khao-sat/create'" class="btn btn-success btn-sm">
                        Thêm
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td class="text-center">{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td class="text-center">{{$post->respondent}}</td>
                    <td class="text-center">{{($post->user)->name}}</td>
                    <td class="text-center">@if($post->status ==1)
                            <span class="text-success"><i class="fa fa-check"></i></span>
                        @else
                            <span class="text-danger"><i class="fa fa-times"></i></span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-sm btn-warning"
                                onclick="location.href = '/admin/khao-sat/{{$post->id}}'">Sửa
                        </button>
                        <form class="ml-1" action="{{route('khao-sat.destroy', $post->id)}}" method="post"
                              onsubmit="return confirm('Tất cả các dữ liệu liên quan sẽ bị xóa. Tôi đồng ý?');">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@stop
