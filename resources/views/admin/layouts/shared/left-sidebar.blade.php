<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="#" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{asset('web/images/svg/logo_inline.svg')}}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{asset('web/images/svg/logo_inline.svg')}}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="#" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{asset('web/images/svg/logo_inline.svg')}}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{asset('web/images/svg/logo_inline.svg')}}" alt="small logo">
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

            @can('user.list')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers" class="side-nav-link">
                    <i class="ri-user-settings-line"></i>
                    <span> User Management </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('users.index') }}">Users</a>
                        </li>
                        @can('role.list')
                        <li>
                            <a href="{{ route('admin.roles.index') }}">Roles</a>
                        </li>
                        @endcan
                        @can('permission.list')
                        <li>
                            <a href="{{ route('admin.permissions.index') }}">Permissions</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endcan

            @can('category.manage')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCategories" aria-expanded="false" aria-controls="sidebarCategories" class="side-nav-link">
                    <i class="ri-folder-line"></i>
                    <span> Categories </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCategories">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('categories.index') }}">All Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('categories.create') }}">Add Category</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @can('service.add')
            <li class="side-nav-item">
                <a href="{{ route('services.index') }}" class="side-nav-link">
                    <i class="ri-customer-service-2-line"></i>
                    <span> Services </span>
                </a>
            </li>
            @endcan

            @can('media.add')
            <li class="side-nav-item">
                <a href="{{ route('media.index') }}" class="side-nav-link">
                    <i class="ri-image-2-line"></i>
                    <span> Media </span>
                </a>
            </li>
            @endcan

            @can('enquiry.view')
            <li class="side-nav-item">
                <a href="{{ route('enquiries.index') }}" class="side-nav-link">
                    <i class="ri-mail-line"></i>
                    <span> Enquiries </span>
                </a>
            </li>
            @endcan

            @can('contact.view')
            <li class="side-nav-item">
                <a href="{{ route('contacts.index') }}" class="side-nav-link">
                    <i class="ri-contacts-line"></i>
                    <span> Contact </span>
                </a>
            </li>
            @endcan

            @can('user.profile')
            <li class="side-nav-item">
                <a href="{{ route('users.profile') }}" class="side-nav-link">
                    <i class="ri-user-line"></i>
                    <span> My Profile </span>
                </a>
            </li>
            @endcan

            <li class="side-nav-item">
                <a href="{{ route('logout') }}" class="side-nav-link" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-line"></i>
                    <span> Logout </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->