<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
$menu = 'menu-open';
$active = 'active menu-open';

$client= Request::is("admin/client*");
$service = Request::is("admin/service*");
$about = Request::is("admin/about*");
$general = Request::is("admin/company-information*");
$socialNav = Request::is("admin/social*");
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('admin.dashboard')}}" class="brand-link">
               <img src="{{asset('images/default.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/default.png') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Muniraj</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @include('layouts.admin.sidebar.allnav')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
