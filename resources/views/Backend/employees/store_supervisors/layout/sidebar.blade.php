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

                <li class="{{ Request::is('employee/store-supervisor/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('store_supervisor_dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="submenu {{ Request::is('employee/store-supervisor/view/requests') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-file-signature"></i> <span> Requsets </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('employee/store-supervisor/view/requests')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('view_requests') }}" class="{{ Request::is('employee/store-supervisor/view/requests') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

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
