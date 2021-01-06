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
    <div class="form-group mb-2 d-flex align-items-center">
        <label class="mb-0" for="post">Khảo sát: </label>
        <select class="form-control w-auto" name="post" id="post" onchange="location.href = '?s='+$('#post').val()">
            @foreach($posts as $post)
                <option {{isset($_GET['s']) && $_GET['s'] == $post->id ? 'selected':''}} value="{{$post->id}}">{{$post->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="callout-top callout-top-danger col-md-12">
        <table id="data-table" align="center" width="100%"
               class="table table-hover table-striped table-bordered border">
            <thead>
            <tr class="bg-primary">
                <th class="text-center">Mã câu hỏi</th>
                <th class="text-center">Nội dung</th>
                <th class="text-center">Câu trả lời</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">
                    <button onclick="location.href = '/dashboard/cau-hoi/create'" class="btn btn-success btn-sm">
                        Thêm
                    </button>
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>CH00{{$question->id}}</td>
                    <td>{{$question->content}}</td>
                    <td>
                        <ol type="A">
                            @foreach(explode(',', $question->answers) as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td class="text-center">@if($question->status ==1)
                            <span class="text-success"><i class="fa fa-check"></i></span>
                        @else
                            <span class="text-danger"><i class="fa fa-times"></i></span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-sm btn-warning"
                                onclick="location.href = '/dashboard/cau-hoi/{{$question->id}}'">Sửa
                        </button>
                        <form class="ml-1" action="{{route('cau-hoi.destroy', $question->id)}}" method="post"
                              onsubmit="return confirm('Đồng ý xoá?');">
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
