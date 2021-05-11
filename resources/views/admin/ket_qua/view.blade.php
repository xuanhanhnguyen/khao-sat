{{-- resources/views/admin/dashboard.blade.php --}}

@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>{{$post->title}}</h1>
@stop

@section('content')
    @php($color = ['primary', 'success', 'warning', 'danger', 'primary', 'success', 'warning', 'danger'])

    <div class="row">
        @foreach($post->result as $key=>$value)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-{{$color[$key]}} text-center p-2">
                    <h3>{{chr(65+$key)}}. {{round($value/($post->questions()->count()*sizeof($post->results)) * 100, 2)}}%</h3>
                </div>
            </div>
        @endforeach
    </div>
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
                <th class="text-center">ID</th>
                <th class="text-center">Người trả lời</th>
                <th class="text-center">Kết quả</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($post->results as $key => $result)
                <tr>
                    <td class="text-center">{{$result->user->id}}</td>
                    <td>{{$result->user->name}}</td>
                    <td>
                        <ol type="A">
                            @foreach($result->result as $k => $value)
                                <li>
                                    <span class="badge badge-{{$color[$k]}}">{{round($value/$post->questions()->count() * 100, 2)}}%</span>
                                </li>
                            @endforeach
                        </ol>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="window.open('/{{$post->slug}}.html?user_id={{$result->user->id}}')">Xem
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@stop
