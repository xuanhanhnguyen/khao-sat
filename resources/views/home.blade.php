@extends('layouts.theme')

@section('main')
    <section class="main container">
        <div class="box">
            <div class="box-header">
                <h2>Danh sách bài khảo sát mới nhất</h2>
                <a href="#">Xem thêm >></a>
            </div>
            <div class="box-content">
                <ul>
                    @foreach($post_new as $post)
                        <li><a href="{{route('detail', $post->slug)}}">{{$post->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        @if(isset($post_result))
            <div class="box mt-2">
                <div class="box-header">
                    <h2>Danh sách bài đã khảo sát</h2>
                    <a href="#">Xem thêm >></a>
                </div>
                <div class="box-content">
                    <ul>
                        @foreach($post_result as $result)
                            <li><a href="{{route('detail', $result->post->slug)}}">{{$result->post->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(isset($post_student))
            <div class="box mt-2">
                <div class="box-header">
                    <h2>Danh sách bài khảo sát cho sinh viên</h2>
                    <a href="#">Xem thêm >></a>
                </div>
                <div class="box-content">
                    <ul>
                        @foreach($post_student as $post)
                            <li><a href="{{route('detail', $post->slug)}}">{{$post->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(isset($post_teacher))
            <div class="box mt-2">
                <div class="box-header">
                    <h2>Danh sách bài khảo sát cho giảng viên</h2>
                    <a href="#">Xem thêm >></a>
                </div>
                <div class="box-content">
                    <ul>
                        @foreach($post_teacher as $post)
                            <li><a href="{{route('detail', $post->slug)}}">{{$post->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(isset($post_enterprise))
            <div class="box mt-2">
                <div class="box-header">
                    <h2>Danh sách bài khảo sát cho doanh nghiệp</h2>
                    <a href="#">Xem thêm >></a>
                </div>
                <div class="box-content">
                    <ul>
                        @foreach($post_enterprise as $post)
                            <li><a href="{{route('detail', $post->slug)}}">{{$post->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </section>
@endsection