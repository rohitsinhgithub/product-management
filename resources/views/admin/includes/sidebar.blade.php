<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="logo">
        <span class="logo-lg">
            <span style="color: #FFD700; font-size: 24px; font-weight: bold;">Flow</span> <span style="color: #87CEEB; font-size: 24px; font-weight: bold;">Masters</span>
        </span>
        <span class="logo-sm">
            <span style="font-weight: bold; font-size: 18px;"><span style="color: #FFD700;">F</span><span style="color: #87CEEB;">M</span></span>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <ul class="side-nav">
            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('users.index') }}" class="side-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            

            <li class="side-nav-item">
                <a href="{{ route('admin.categories.index') }}" class="side-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Categories</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('items.index') }}" class="side-nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>
                    <span>Items Master</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('vendors.index') }}" class="side-nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>
                    <span>vendor</span>
                </a>
            </li>
            

            @if(auth()->user()->can('role.list') || auth()->user()->can('permission.list'))
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#settingsMenu" aria-expanded="false" aria-controls="settingsMenu" 
                   class="side-nav-link">
                    <i class="fas fa-cogs"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="settingsMenu">
                    <ul class="side-nav-second-level">
        
                        <li>
                            <a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                <i class="fas fa-user-tag"></i> Roles
                            </a>
                        </li>
                        

        
                        <li>
                            <a href="{{ route('admin.permissions.index') }}" class="{{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                                <i class="fas fa-key"></i> Permissions
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            @endif

            <li class="side-nav-item">
                {{-- <a href="{{ route('services.index') }}" class="side-nav-link">
                    <i class="fas fa-cogs"></i>
                    <span>Services</span>
                </a> --}}
            </li>
            

            <li class="side-nav-item">
                {{-- <a href="{{ route('media.index') }}" class="side-nav-link">
                    <i class="fas fa-images"></i>
                    <span>Media</span>
                </a> --}}
            </li>
            

            <li class="side-nav-item">
                {{-- <a href="{{ route('enquiries.index') }}" class="side-nav-link">
                    <i class="fas fa-envelope"></i>
                    <span>Enquiries</span>
                </a> --}}
            </li>
            

            <li class="side-nav-item">
                {{-- <a href="{{ route('contacts.index') }}" class="side-nav-link">
                    <i class="fas fa-address-book"></i>
                    <span>Contact</span>
                </a> --}}
            </li>
            

            <li class="side-nav-item">
                {{-- <a href="{{ route('admin.myProfile') }}" class="side-nav-link {{ request()->routeIs('admin.myProfile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span>
                </a> --}}
            </li>
            
        </ul>

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->