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
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}">
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet">
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<header>
    <div class="header-top">
        <nav class="navbar navbar-expand-sm justify-content-center container">
            <a class="navbar-brand ml-auto" href="/"><img src="{{asset('./assets/images/logo.png')}}" alt=""> </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item d-none d-md-block">
                    <h4 class="text-light"><span class="nav-text">TRƯỜNG ĐẠI HỌC VINH</span><br>
                        CỔNG THÔNG TIN SINH VIÊN THỰC TẬP
                    </h4>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main id="login">
    <section class="login">
        <h2 class="text-center font-weight-bold">Đăng nhập</h2>
        <form action="{{route('login')}}" method="post">
            {{ csrf_field() }}

            {{-- Email field --}}
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
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

            {{-- Login field --}}
            <div class="row">
                <div class="col-6">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <a href="/register">Đăng ký</a>
                </div>
                <div class="col-12">
                    <button type=submit
                            class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-sign-in-alt"></span>
                        {{ __('adminlte::adminlte.sign_in') }}
                    </button>
                </div>
            </div>
        </form>
    </section>
</main>
<script src="{{asset('assets/jquery/jquery-v3.5.1.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
