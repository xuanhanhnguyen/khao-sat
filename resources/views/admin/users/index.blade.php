{{-- resources/views/admin/dashboard.blade.php --}}

@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Danh sách tài khoản: </h1>
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
                <th class="text-center">Mã TK</th>
                <th class="text-center">Họ tên</th>
                <th class="text-center">Tài khoản/Email</th>
                <th class="text-center">Điện thoại</th>
                <th class="text-center">Chức vụ</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">
                    <button onclick="location.href = '/dashboard/tai-khoan/create'" class="btn btn-success btn-sm">
                        Thêm
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">TK00{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td class="text-center">{{$user->phone}}</td>
                    <td class="text-center">{{$user->role->name}}</td>
                    <td class="text-center">@if($user->status ==1)
                            <span class="text-success"><i class="fa fa-check"></i></span>
                        @else
                            <span class="text-danger"><i class="fa fa-times"></i></span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-sm btn-warning"
                                onclick="location.href = '/dashboard/tai-khoan/{{$user->id}}'">Sửa
                        </button>
                        <form class="ml-1" action="{{route('tai-khoan.destroy', $user->id)}}" method="post"
                              onsubmit="return confirm('Đồng ý xoá?');" >
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
