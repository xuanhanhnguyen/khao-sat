{{-- resources/views/admin/dashboard.blade.php --}}

@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Danh sách thành viên nhóm khảo sát</h1>
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
                <th class="text-center">Tên thành viên</th>
                <th class="text-center">Email</th>
                <th class="text-center">Ngày tham gia</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modelId">
                        Thêm
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->join as $key=>$post)
                <tr>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->user->email}}</td>
                    <td>{{$post->created_at}}</td>
                    <td class="text-center">
                        @if($post->status == 1)
                            <span class="text-success">Đã tham gia</span>
                        @else
                            <span class="text-danger">Chờ phê duyệt duyệt</span>
                        @endif
                    </td>
                    <td class="">
                        @if($post->status == 0)
                            <button class="btn btn-sm btn-warning"
                                    onclick="location.href = '/dashboard/join-group/{{$data->id}}/{{$post->user->id}}'">
                                Phê duyệt
                            </button>
                        @endif
                        <form class="mt-1" action="/dashboard/join-group/{{$post->id}}" method="post"
                              onsubmit="return confirm('Xóa thành viên. Tôi đồng ý?');">
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

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm thành viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('nhom.add', $data->id)}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="select2">Chọn thành viên:</label>
                        <select id="select2" class="select2 w-100" name="data[]" multiple="multiple">
                            @foreach($users as $user)
                                <option value="<?php echo $user->id ?>"><?php echo $user->email ?></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@stop
