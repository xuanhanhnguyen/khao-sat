@extends('layouts.main')

@section('main')
    @php($color = ['primary', 'success', 'warning', 'danger', 'primary', 'success', 'warning', 'danger'])
    <section class="main container">
        <div class="box box-detail">
            <div class="box-header text-center">
                <h2>KHẢO SÁT Ý KIẾN</h2>
            </div>
            <div class="box-content text-center mt-2">
                <h4 class="text-primary">{{ $post->title }}</h4>
                <p class="my-3">{{ $post->description }}</p>
            </div>

            <div class="box-question">
                <form action="{{ route('save') }}" method="post">
                    @csrf
                    <input type="text" class="d-none" name="post_id" value="{{ $post->id }}">
                    <input type="text" class="d-none" name="slug" value="{{ $post->slug }}">
                    <ul class="list-unstyled">
                        @foreach ($post->questions as $key => $question)
                            <li class="font-weight-bold">
                                <span class="text-primary">{{ $key + 1 }}. {{ $question->content }}</span>
                                <ul class="font-weight-normal" style="list-style: none;">
                                    @foreach (explode(',', $question->answers) as $key => $answer)
                                        <li>
                                            <input value="{{ $key }}"
                                                id="{{ 'answers' . $question->id . '_' . $key }}" class="form-check-input"
                                                type="radio" name="_{{ $question->id }}" required>
                                            <label
                                                for="{{ 'answers' . $question->id . '_' . $key }}">{{ $answer }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                    <button class="btn btn-outline-primary float-right">Chốt đáp án</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </section>
@endsection
