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
                <a href="#" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Master </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('categories.index') }}">Category Master</a>
                        </li>
                    </ul>
                </div>
            </li>


            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Inventory </span>
                    <span class="menu-arrow"></span>
                </a>
            </li> --}}

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="ri-service-line"></i>
                    <span> Add Service </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="ri-gallery-line"></i>
                    <span> Add Photo </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Enquiries </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    {{-- <i class="ri-dashboard-3-line"></i> --}}
                    <span> Contect Us </span>
                </a>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class=" clearfix">
        </div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->