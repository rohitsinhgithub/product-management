<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ url('/admin') }}" class="logo logo-light">
        <span class="logo-lgs">
            {{-- <img src="{{ asset('web/images/logo_inline_lite_556x160.png') }}" alt="logo" style="width: 100%;"> --}}
            <h3>Stock Management</h3>
        </span>
        <span class="logo-sm">
            <img src="{{ asset('web/images/logo_inline_lite_556x160.png') }}" alt="small logo" style="width: 100%;">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ url('/admin') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('web/images/logo_inline_lite_556x160.png') }}" alt="dark logo" style="width: 100%;">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('web/images/logo_inline_lite_556x160.png') }}" alt="small logo" style="width: 100%;">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('admin.index') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            @can('manage categories')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMaster" aria-expanded="false" aria-controls="sidebarMaster" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Master </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMaster">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('categories.index') }}">Category Master</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @if (auth()->user()->can('manage permission') || auth()->user()->can('manage role'))
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarRolePermissions" aria-expanded="false" aria-controls="sidebarRolePermissions" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Role & Permissions </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarRolePermissions">
                    <ul class="side-nav-third-level">
                        @can(`manage role`)
                            <li>
                                <a href="{{ route('roles.index') }}">Roles Master</a>
                            </li>
                        @endcan
                        @can(`manage permission`)
                        <li>
                            <a href="{{ route('permissions.index') }}">Permissions Master</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endif

            @can('add service')
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="ri-service-line"></i>
                    <span> Add Service </span>
                </a>
            </li>
            @endcan

            @can('add photo')
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="ri-gallery-line"></i>
                    <span> Add Photo </span>
                </a>
            </li>
            @endcan

            @can('view enquiries')
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Enquiries </span>
                </a>
            </li>
            @endcan

            @can('view contact')
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    {{-- <i class="ri-dashboard-3-line"></i> --}}
                    <span> Contact Us </span>
                </a>
            </li>
            @endcan

        </ul>
        <!--- End Sidemenu -->

        <div class=" clearfix">
        </div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->