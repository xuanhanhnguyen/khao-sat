@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Thêm câu hỏi: </h1>
@stop

@section('content')
    <div class="callout-top callout-top-danger col-md-12">
        <form action="{{route('cau-hoi.store')}}" method="post">
            {{ csrf_field() }}
            {{--title--}}
            <div class="form-group">
                <label for="content">Nội dung câu hỏi:</label>
                <input type="text" name="content" id="content" value="{{ old('content') }}"
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
                    <li class="mb-2">
                        <input type="text" name="answers[]" value="{{ old('answers') }}"
                               class="form-control">
                    </li>
                    <li class="mb-2">
                        <input type="text" name="answers[]" value="{{ old('answers') }}"
                               class="form-control">
                    </li>
                    <li class="mb-2">
                        <input type="text" name="answers[]" value="{{ old('answers') }}"
                               class="form-control">
                    </li>
                    <li class="mb-2">
                        <input type="text" name="answers[]" value="{{ old('answers') }}"
                               class="form-control">
                    </li>
                </ol>
                <div class="text-center">
                    <a class="text-primary" style="cursor: pointer" onclick="appendAnswer()">Thêm câu trả lời?</a>
                    <script>
                        function appendAnswer() {
                            let html = '<li class="mb-2">\n' +
                                '    <input type="text" name="answers[]" value="{{ old("answers") }}"\n' +
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
                <button type="submit" class="btn btn-sm btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
@stop
@stop
