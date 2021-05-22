@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')
    <h1>Thêm nhóm khảo sát mới</h1>
@stop

@section('content')
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
        <form action="{{route('nhom.store')}}" method="post">
            {{ csrf_field() }}
            {{--name--}}
            <div class="form-group">
                <label for="name">Tên nhóm:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            {{--description--}}
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                          id="description" cols="30" rows="5"
                          required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </div>
                @endif
            </div>
            {{--respondent--}}
            <div class="form-group">
                <label for="limit" class="{{ $errors->has('limit') ? 'is-invalid' : '' }}">
                    Giới hạn thành viên:</label>
                <div class="row text-center px-2">
                    <div class="form-check col-md-4">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="limit[]" id="" value="Sinh viên">
                            Sinh viên
                        </label>
                    </div>
                    <div class="form-check col-md-4">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="limit[]" id=""
                                   value="Giảng viên">
                            Giảng viên
                        </label>
                    </div>
                    <div class="form-check col-md-4">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="limit[]" value="Doanh nghiệp">
                            Doanh nghiệp
                        </label>
                    </div>
                </div>
                @if($errors->has('limit'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('limit') }}</strong>
                    </div>
                @endif
            </div>
            {{--status--}}
            <div class="form-group">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option value="1">Công khai</option>
                    <option value="0">Nhóm kín</option>
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
