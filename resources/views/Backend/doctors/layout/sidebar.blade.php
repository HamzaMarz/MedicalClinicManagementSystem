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

                <li class="{{ Request::is('doctor/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('doctor_dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="submenu {{ Request::is('doctor/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-user-circle"></i> <span> My Profile </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('doctor/profile')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('doctor_profile') }}" class="{{ Request::is('doctor/profile') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ Request::is('doctor/my-schedule') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-calendar-alt"></i> <span> My Schedule </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('doctor/my-schedule')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('doctor_mySchedule') }}" class="{{ Request::is('doctor/my-schedule') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ Request::is('doctor/add/patient') || Request::is('doctor/view/patients') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-user-injured"></i> <span> Patients </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('doctor/view/doctors')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('doctor_add_patient') }}" class="{{ Request::is('doctor/add/patient') ? 'active' : '' }}">Add</a>
                        </li>

                        <li>
                            <a href="{{ route('doctor_view_patients') }}" class="{{ Request::is('doctor/view/patients') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <ul>
                <li class="menu-title">Medical Operations</li>

                <li class="submenu {{ Request::is('doctor/add/prescription') || Request::is('doctor/view/prescriptions') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-file-medical"></i> <span> Prescriptions </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('doctor/add/prescription') || Request::is('doctor/view/prescriptions') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('doctor_add_prescription') }}" class="{{ Request::is('doctor/add/prescription') ? 'active' : '' }}">Add</a>
                        </li>

                        <li>
                            <a href="{{ route('doctor_view_prescriptions') }}" class="{{ Request::is('doctor/view/prescriptions') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

            </ul>



            <ul>
                <li class="menu-title">Doctor Reports</li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-chart-line"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="">View Reports</a></li>
                    </ul>
                </li>

            </ul>


            <ul>
                <li class="menu-title">System</li>

                <li class="submenu {{ Request::is('doctor/edit/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('doctor/edit/profile') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('edit_profile') }}"
                               class="{{ Request::is('doctor/edit/profile') ? 'active' : '' }}">
                               Edit My Profile
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
