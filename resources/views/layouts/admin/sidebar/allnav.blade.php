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
<li class="nav-item">
    <a href="{{ route('admin.client.category.index') }}" class="nav-link @yield('client-category')">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>Client Category</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('admin.client.index') }}" class="nav-link @yield('client')">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>Client</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('admin.team.index') }}" class="nav-link @yield('team')">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>Team</p>
    </a>
</li>

