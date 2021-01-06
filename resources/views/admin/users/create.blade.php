@extends('admin.layouts.app')

@section('main')
@section('title', 'Khảo sát - Đại học vinh')

@section('content_header')

@stop

@section('content')
    <main id="register">
        <section class="register">
            <h2 class="text-center font-weight-bold">Thêm tài khoản</h2>
            <form action="{{route('tai-khoan.store')}}" method="post">
                {{ csrf_field() }}

                {{-- Name field --}}
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </div>

                {{-- Email field --}}
                <div class="input-group mb-3">
                    <input type="email" name="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                {{-- Password field --}}
                <div class="input-group mb-3">
                    <input type="password" name="password"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                {{-- Confirm password field --}}
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation"
                           class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
                    @if($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>

                {{-- role field --}}
                <div class="input-group mb-3">
                    <select name="role_id" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">Sinh viên</option>
                        <option value="3">Giảng viên</option>
                        <option value="4">Doanh nghiệp</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-users-cog"></span>
                        </div>
                    </div>
                </div>

                {{-- Register button --}}
                <button type="submit"
                        class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-user-plus"></span>
                    Thêm mới
                </button>
            </form>
        </section>

    </main>
@stop
@stop
