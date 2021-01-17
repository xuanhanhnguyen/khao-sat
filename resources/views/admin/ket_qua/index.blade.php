{{-- resources/views/admin/dashboard.blade.php --}}

@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Kết quả khảo sát</h1>
@stop

@section('content')
    @php($color = ['primary', 'success', 'warning', 'danger', 'primary', 'success', 'warning', 'danger'])
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
                <th class="text-center">Mã KS</th>
                <th class="text-center">Bài khảo sát</th>
                <th class="text-center">Kết quả</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td class="text-center">{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>
                        <ol type="A">
                            @foreach($post->result as $key => $value)
                                <li>
                                    <span class="badge badge-{{$color[$key]}}">{{$value/($post->questions()->count()*sizeof($post->results)) * 100}}%</span>
                                </li>
                            @endforeach
                        </ol>
                    </td>
                    <td class="text-center">
                        {{sizeof($post->results)}}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="location.href = 'ket-qua/{{$post->id}}'">Xem
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@stop
