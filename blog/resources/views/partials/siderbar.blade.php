<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('categories.index')}}" class="nav-link">
                        <p>
                            Danh mục sản phẩm
                        </p>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('menus.index')}}" class="nav-link">--}}
{{--                        <p>--}}
{{--                            Menu--}}
{{--                        </p>--}}
{{--                    </a>--}}

{{--                </li>--}}
                <li class="nav-item">
                    <a href="{{ route('product.index')}}" class="nav-link">
                        <p>
                            Sản phẩm
                        </p>
                    </a>

                </li>
                @can('slider-list')
                <li class="nav-item">
                    <a href="{{route('slider.index')}}" class="nav-link">
                        <p>
                            Slider
                        </p>
                    </a>

                </li>
                @endcan
                @can('user-list')
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <p>
                            Danh sách nhân viên
                        </p>
                    </a>

                </li>
                @endcan
                @can('role-list')
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <p>
                            Danh sách vai trò
                        </p>
                    </a>

                </li>
                @endcan
{{--                @can('admin_role_simple')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('permissions.create')}}" class="nav-link">--}}
{{--                        <p>--}}
{{--                            Tạo dữ liệu bảng Permission--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}
{{--                @can('admin_role_simple')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('roleAdmin.index')}}" class="nav-link">--}}
{{--                            <p>--}}
{{--                                Set quyền admin--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
