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

                @if (session('message'))
                    <p class="text-center text-success">{{ session('message') }}</p>
                @elseif(is_null($result))
                    <form action="" method="post">
                        @csrf
                        <button class="btn btn-sm btn-primary">Thực hiện khảo sát</button>
                    </form>
                @else
                    <p class="text-center text-success font-weight-bold">Đã thực hiện khảo sát.</p>
                @endif
            </div>

            @if (!is_null($result))
                <div class="box-question">
                    <ul class="list-unstyled">
                        @foreach ($post->questions as $key => $question)
                            <li class="font-weight-bold">
                                <span class="text-primary">{{ $key + 1 }}. {{ $question->content }}</span>
                                <ul class="font-weight-normal" style="list-style:none;">
                                    @foreach (explode(',', $question->answers) as $key => $answer)
                                        <li>
                                            <input value="{{ $key }}"
                                                id="{{ 'answers' . $question->id . '_' . $key }}" class="form-check-input"
                                                type="radio" name="_{{ $question->id }}"
                                                @if (isset($result['_' . $question->id]) && $result['_' . $question->id] == $key) checked @else disabled @endif>
                                            <label
                                                for="{{ 'answers' . $question->id . '_' . $key }}">{{ $answer }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <p class="text-center text-success font-weight-bold">Đã thực hiện khảo sát.</p>
            @endif
        </div>
    </section>
@endsection
