@extends('adminlte::page')

@yield('main')

@section('css')
    <link rel="stylesheet" href="{{asset('/_admin/admin_custom.css')}}">
    @yield('css')
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#data-table').DataTable(
                {
                    "oLanguage": {
                        "sProcessing": "Đang xử lý...",
                        "sLengthMenu": "Xem _MENU_ mục",
                        "sZeroRecords": "không có dữ liệu",
                        "sInfo": "_TOTAL_ mục",
                        "sInfoEmpty": "0 mục",
                        "sInfoFiltered": "",
                        "sInfoPostFix": "",
                        "sSearch": "Tìm:",
                        "sUrl": "",
                        "oPaginate": {
                            "sPrevious": "<",
                            "sNext": ">",
                        }
                    }
                }
            );
            $('.select2').select2();
        });
    </script>
    <script src="/ckeditor/ckeditor.js"></script>
    @yield('js')
@stop