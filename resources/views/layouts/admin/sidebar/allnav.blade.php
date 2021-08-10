<li class="nav-item">
    <a href="{{ route('admin.user.index') }}" class="nav-link @yield('user')">
        <i class="nav-icon fa fa-users iCheck"></i>
        <p>Users</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.product.index') }}" class="nav-link @yield('product')">
        <i class="nav-icon fab fa-product-hunt iCheck"></i>
        <p>Product</p>
    </a>
</li>

<li class="nav-item {{ $client ? $menu : '' }}">
    <a href="#" class="nav-link {{ $client ? $active : '' }}">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>
            Client
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.client.category.index') }}" class="nav-link @yield('client-category')">
                <i class="nav-icon far fa-circle iCheck"></i>
                <p>Client Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.client.index') }}" class="nav-link @yield('client')">
                <i class="nav-icon far fa-circle iCheck"></i>
                <p>Client</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('admin.team.index') }}" class="nav-link @yield('team')">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>Team</p>
    </a>
</li>

<li class="nav-item {{ $service ? $menu : '' }}">
    <a href="#" class="nav-link {{ $service ? $active : '' }}">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>
            Service
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.service.category.index') }}" class="nav-link @yield('service-category')">
                <i class="nav-icon far fa-circle iCheck"></i>
                <p>Service Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.service.index') }}" class="nav-link @yield('service')">
                <i class="nav-icon far fa-circle iCheck"></i>
                <p>Services</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{ $about || $general || $socialNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $about || $general || $socialNav ? $active : '' }}">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>
            General Settings
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.about.index') }}" class="nav-link @yield('about')">
                <i class="nav-icon far fa-circle iCheck"></i>
                <p>About</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.general.index') }}" class="nav-link @yield('general-setting')">
                <i class="nav-icon fa fa-building iCheck"></i>
                <p>Company Information</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.social.index') }}" class="nav-link @yield('social')">
                <i class="nav-icon fa fa-share-alt iCheck"></i>
                <p>Socials</p>
            </a>
        </li>
    </ul>
</li>
