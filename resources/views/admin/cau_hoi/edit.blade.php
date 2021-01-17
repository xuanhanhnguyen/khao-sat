@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Sửa câu hỏi</h1>
@stop

@section('content')
    <div class="callout-top callout-top-danger col-md-12">
        <form action="{{route('cau-hoi.update', $question->id)}}" method="post">
            {{ csrf_field() }}
            @method('put')
            <input type="text" name="post_id" value="{{$question->post_id}}"
                   class="form-control d-none">
            {{--title--}}
            <div class="form-group">
                <label for="content">Nội dung câu hỏi:</label>
                <input type="text" name="content" id="content" value="{{$question->content}}"
                       class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('content') }}</strong>
                    </div>
                @endif
            </div>

            <div class="answers {{ $errors->has('answers') ? 'is-invalid' : '' }}">
                <label for="answers">Câu trả lời:</label>
                <ol type="A" id="answers">
                    @foreach(explode(',' , $question->answers) as $answer)
                        <li class="mb-2">
                            <input type="text" name="answers[]" value="{{$answer}}"
                                   class="form-control">
                        </li>
                    @endforeach
                </ol>
                <div class="text-center">
                    <a class="text-primary" style="cursor: pointer" onclick="appendAnswer()">Thêm câu trả lời?</a>
                    <script>
                        function appendAnswer() {
                            let html = '<li class="mb-2">\n' +
                                '    <input type="text" name="answers[]" value="" \n' +
                                '           class="form-control">\n' +
                                '</li>';
                            $('#answers').append(html);
                        }
                    </script>
                </div>
            </div>
            @if($errors->has('answers'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('answers') }}</strong>
                </div>
            @endif

            {{--status--}}
            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('status') }}</strong>
                    </div>
                @endif
            </div>
            {{--button--}}
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-warning">Cập nhật</button>
            </div>
        </form>
    </div>
@stop
@stop
