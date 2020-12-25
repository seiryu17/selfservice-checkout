<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{route('dashboard')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">Brands</li><!-- /.menu-title -->
                <li class="">
                <a href="{{route('brands.index')}}"> <i class="menu-icon fa fa-tag"></i>Brands Detail</a>
                </li>
                {{-- <li class="">
                    <a href=""> <i class="menu-icon fa fa-plus"></i>Tambah Barang</a>
                </li> --}}

                <li class="menu-title">Item Categories</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{route('categories.index')}}"> <i class="menu-icon fa fa-cubes"></i>Categories Detail</a>
                </li>
                {{-- <li class="">
                    <a href=""> <i class="menu-icon fa fa-plus"></i>Tambah Foto Barang</a>
                </li> --}}

                <li class="menu-title">Items</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{route('items.index')}}"> <i class="menu-icon fa fa-cart-plus"></i>Items Detail</a>
                </li>

                <li class="menu-title">Suppliers</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{route('suppliers.index')}}"> <i class="menu-icon fa fa-address-card"></i>Suppliers Detail</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>