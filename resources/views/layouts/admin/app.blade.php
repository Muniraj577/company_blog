<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ env('APP_NAME') }} @hasSection('title') | @yield('title') @endif
</title>
<link rel="icon" href="{{ asset('images/inventory.png') }}" type="image/*" sizes="16x16">
    @include('layouts.admin.style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
        @include('layouts.admin.header')
    
<!-- Main Sidebar Container -->
   
        @include('layouts.admin.sidebar')
    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="loading" style="position: absolute; left: 50%; top: 60%;z-index: 1000000;display: none;">
            <img src="{{ asset('loader.gif') }}" class="img-fluid mx-auto d-block" style="height: 200px;" alt="">
        </div>
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    
        @include('layouts.admin.footer')
    
</div>
<!-- ./wrapper -->
    @include('layouts.admin.script')
</body>
</html>
