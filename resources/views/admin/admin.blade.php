<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Fort Admin LTE | Starter</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('admin.layouts.navbar')

    @include('admin.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.layouts.content-header')

        {{--@include('admin.layouts.main-content')--}}

        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    @include('admin.layouts.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

@include('admin.layouts.status-block')

<script src="{{ asset('src/js/jon_func.js') }}"></script>

<!-- незабыть добавить на кликаемой кнопе id="add-user-button"
<script>
    $('#add-user-button').on('click', function () {
        Swal.fire({
            toast: true,
            type: 'success',
            icon: 'success',
            position: 'top-end',
            title: 'Пользователь добавлен успешно!',
            showConfirmButton: false,
            timer: 2500
        })
    })
</script>
-->

{{-- оки тут это работает
<script>
    @if(session('status'))
        Swal.fire({
            toast: true,
            type: 'success',
            icon: 'success',
            position: 'top-end',
            title: "{{ session('status') }}",
            showConfirmButton: false,
            timer: 2500
        });
    @endif
</script>--}}


</body>
</html>

