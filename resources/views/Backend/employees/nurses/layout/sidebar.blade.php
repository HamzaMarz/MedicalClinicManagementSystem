<style>
    .sidebar-menu li ul li a.active {
        color: #009efb !important;
        font-weight: bold;
        text-decoration: none !important;
    }


    .sidebar-menu li ul li a {
        color: #555 !important;
    }
</style>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Core Modules</li>

                <li class="{{ Request::is('employee/nurse/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('nurse_dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li class="submenu {{ Request::is('admin/clinic/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-hospital"></i> <span> Clinic </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/clinic/profile')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('clinic_profile') }}" class="{{ Request::is('admin/clinic/profile') ? 'active' : '' }}">Profile</a>
                        </li>
                    </ul>
                </li> --}}

            </ul>

            <ul>
                <li class="menu-title">Medical Operations</li>


            </ul>




            <ul>
                <li class="menu-title">System</li>



            </ul>
        </div>
    </div>
</div>
