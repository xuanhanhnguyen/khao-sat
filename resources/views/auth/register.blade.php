<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Khảo sát - Đại học vinh</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet">
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="p-0">
<header>
    <div class="header-top">
        <nav class="navbar navbar-expand-sm justify-content-center container-fluid">
            <a class="navbar-brand" href="/"><img src="{{ asset('./assets/images/logo.png') }}" alt=""> </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item d-none d-md-block">
                    <h4 class="text-light text-center" style="font-family: -webkit-body;font-size: 18px;">
                        HỆ THỐNG KHẢO SÁT SINH VIÊN NGÀNH CÔNG NGHỆ THÔNG TIN <br> TRƯỜNG ĐẠI HỌC VINH
                    </h4>
                </li>
            </ul>
        </nav>
    </div>
</header>
<main id="register">
    <section class="register mt-5">
        <h2 class="text-center font-weight-bold">Đăng ký thành viên</h2>
        <form action="{{ route('register') }}" method="post">
            {{ csrf_field() }}

            {{-- Name field --}}
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>

            {{-- Email field --}}
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>

            {{-- Password field --}}
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                <input type="password" name="password"
                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="{{ __('adminlte::adminlte.password') }}">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
            </div>

            {{-- Confirm password field --}}
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                <input type="password" name="password_confirmation"
                       class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                       placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                @if($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </div>
                @endif
            </div>

            {{-- role field --}}
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-users-cog"></span>
                    </div>
                </div>

                <select name="role_id" class="form-control">
                    <option value="2">Sinh viên</option>
                    <option value="3">Giảng viên</option>
                    <option value="4">Doanh nghiệp</option>
                </select>
            </div>

            {{-- Register button --}}
            <button type="submit"
                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                <span class="fas fa-user-plus"></span>
                {{ __('adminlte::adminlte.register') }}
            </button>

            <div class="mt-2">
                <button type=button onclick="location.href = '/login'" class="btn btn-info btn-block">
                    <span class="fas fa-sign-in-alt"></span>
                    Đăng nhập
                </button>
            </div>
        </form>
    </section>

</main>
<script src="{{asset('assets/jquery/jquery-v3.5.1.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>