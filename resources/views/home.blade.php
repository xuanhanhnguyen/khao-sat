@extends('layouts.main')

@section('main')
    <section class="main container">
        <div class="box">
            <div class="box-header">
                <h2>Khảo sát ngay</h2>
            </div>
            <div class="box-content">
                <ul class="list-unstyled pl-3">
                    @foreach ($post_new as $post)
                        <li><i class="fas fa-arrow-right"></i> <a
                                href="{{ route('detail', $post->slug) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        @if (isset($post_result))
            <div class="box mt-2">
                <div class="box-header">
                    <h2>Đã khảo sát</h2>
                </div>
                <div class="box-content">
                    <ul class="list-unstyled pl-3">
                        @foreach ($post_result as $result)
                            <li><i class="fas fa-check"></i> <a
                                    href="{{ route('detail', $result->post->slug) }}">{{ $result->post->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </section>
@endsection
