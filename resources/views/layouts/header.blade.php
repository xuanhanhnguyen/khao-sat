<div class="header-top">
    <nav class="navbar navbar-expand-sm justify-content-center container">
        <a class="navbar-brand ml-auto" href="/"><img src="{{asset('./assets/images/logo.png')}}" alt=""> </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item d-none d-md-block">
                <h4 class="text-light"><span class="nav-text">TRƯỜNG ĐẠI HỌC VINH</span><br>
{{--                    CỔNG THÔNG TIN SINH VIÊN THỰC TẬP--}}
                </h4>
            </li>
        </ul>
    </nav>
</div>

<ul class="menu-right">
    @if (Auth::check())
        <li><i class="fas fa-user"></i> {{Auth::user()->name}}</li>
    @endif
    <li><a href="/">Trang chủ</a></li>
    @if (Auth::check())
        <li>
            <form id="logout" action="{{route('logout')}}" method="post">
                @csrf
                <a href="#"><i onclick="$('#logout').submit()" class="fas fa-sign-out-alt"></i></a>
            </form>
        </li>
    @else
        <li><a href="/login">Đăng nhập</a></li>
    @endif

</ul>
<div class="clearfix"></div>