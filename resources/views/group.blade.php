@extends('layouts.main')

@section('main')
    <section class="main container">
        <div class="box">
            <div class="box-header">
                <h2>Danh sách nhóm tham gia</h2>
            </div>
            <div class="box-content">
                <ul>
                    @foreach($data as $item)
                        <li><a href="{{route('nhom.detail', $item->id)}}">{{$item->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="box mt-2">
            <div class="box-header">
                <h2>Danh sách nhóm khác</h2>
            </div>
            <div class="box-content">
                <ul>
                    @foreach($more as $item)
                        <li><a href="{{route('nhom.detail', $item->id)}}">{{$item->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection