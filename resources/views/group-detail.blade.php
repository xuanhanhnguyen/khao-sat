@extends('layouts.main')

@section('main')
    @php($color = ['primary', 'success', 'warning', 'danger', 'primary', 'success', 'warning', 'danger'])

    <section class="main container">
        <div class="box box-detail">
            <div class="box-header">
                <h2>{{$data->name}} ({{$data->users->count()}})</h2>
            </div>
            <div class="box-content text-center">
                <p>{{$data->description}}</p>


                @if(is_null($join))
                    <form action="{{route('nhom.join', $data->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{\Auth::id()}}">
                        <button class="btn btn-sm btn-warning">Tham gia</button>
                    </form>
                @elseif(is_null($pd))
                    <p class="text-center text-success font-weight-bold">Đang chờ duyệt.</p>
                @else
                    <p class="text-center text-success font-weight-bold">Đã tham gia.</p>
                @endif
            </div>
            @if(!is_null($pd))
                <div class="box mt-4">
                    <div class="box-header">
                        <h2>Danh sách bài khảo sát của nhóm</h2>
                    </div>
                    <div class="box-content">
                        <ul>
                            @foreach($data->posts as $post)
                                <li><a href="{{route('detail', $post->slug)}}">{{$post->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="box-footer container mt-2">
                <div>
                    <h2>{{$data->name}} ({{$data->users->count()}})</h2>
                </div>
            </div>
        </div>
    </section>
@endsection