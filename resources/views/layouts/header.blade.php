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

    <div class="box-user">
        <small>
            <span class="text-primary"><i class="fas fa-user"></i> {{ Auth::user()->name }}</span>
            vai trò: <span class="text-primary">{{ Auth::user()->role->name }}</span>
        </small>
    </div>
</div>

<ul class="menu-right">
    <li><a href="/">Trang chủ</a></li>
    <li>

        <form id="logout" action="{{ route('logout') }}" method="post">
            @csrf
            <a href="#" onclick="event.preventDefault(); $('#logout').submit();">
                Thoát <i class="fas fa-sign-out-alt"></i>
            </a>
        </form>
    </li>

</ul>
<div class="clearfix"></div>
