@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Sửa thông tin bài khảo sát: </h1>
@stop

@section('content')
    <div class="callout-top callout-top-danger col-md-12">
        <form action="{{route('khao-sat.update', $post->id)}}" method="post">
            {{ csrf_field() }}
            @method('put')
            {{--title--}}
            <div class="form-group">
                <label for="title">Tiêu đề:</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}"
                       class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('title') }}</strong>
                    </div>
                @endif
            </div>
            {{--description--}}
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                          id="description" cols="30" rows="5"
                          required>{{ $post->description }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </div>
                @endif
            </div>
            {{--respondent--}}
            <div class="form-group">
                <label for="respondent" class="{{ $errors->has('respondent') ? 'is-invalid' : '' }}">
                    Đối tượng khảo sát:</label>
                <div class="row text-center px-2">
                    <div class="form-check col-md-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="respondent[]" id=""
                                   value="Admin" {{array_search('Admin', explode(',', $post->respondent)) !== false ? 'checked':''}}>
                            Admin
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="respondent[]" id=""
                                   value="Sinh viên" {{array_search('Sinh viên', explode(',', $post->respondent)) !== false ? 'checked':''}}>
                            Sinh viên
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="respondent[]" id=""
                                   value="Giảng viên" {{array_search('Giảng viên', explode(',', $post->respondent)) !== false ? 'checked':''}}>
                            Giảng viên
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="respondent[]" value="Doanh nghiệp"
                                    {{array_search('Doanh nghiệp', explode(',', $post->respondent)) !== false ? 'checked':''}}>
                            Doanh nghiệp
                        </label>
                    </div>
                </div>
                @if($errors->has('respondent'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('respondent') }}</strong>
                    </div>
                @endif
            </div>
            {{--status--}}
            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option {{$post->status == 1 ? 'selected':""}} value="1">Hiển thị</option>
                    <option {{$post->status == 0 ? 'selected':""}} value="0">Ẩn</option>
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
