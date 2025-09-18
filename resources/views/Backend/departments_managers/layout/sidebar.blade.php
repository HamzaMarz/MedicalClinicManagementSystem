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

                <li class="{{ Request::is('department-manager/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('department_manager_dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="submenu {{ Request::is('department-manager/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-user-circle"></i> <span> My Profile </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/profile')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_profile') }}" class="{{ Request::is('department-manager/profile') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('department-manager/view/specialties') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-stethoscope"></i> <span> Specialties </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/view/specialties')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_view_specialties') }}" class="{{ Request::is('department-manager/view/specialties') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('department-manager/view/employees') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/view/employees')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_view_employees') }}" class="{{ Request::is('department-manager/view/employees') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('department-manager/view/doctors') ? 'active' : '' }}">
                    <a href="#"><i class="fa-solid fa-user-doctor"></i> <span> Doctors </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/view/doctors')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_view_doctors') }}" class="{{ Request::is('department-manager/view/doctors') ? 'active' : '' }}">View</a>
                        </li>

                        <li>
                            <a href="{{ route('department_manager_view_doctors_schedules') }}" class="{{ Request::is('department-manager/view/doctors-schedules') ? 'active' : '' }}">Doctors Schedules</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('department-manager/add/patient') || Request::is('department-manager/view/patients') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-user-injured"></i> <span> Patients </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/view/doctors')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_add_patient') }}" class="{{ Request::is('department-manager/add/patient') ? 'active' : '' }}">Add</a>
                        </li>

                        <li>
                            <a href="{{ route('department_manager_view_patients') }}" class="{{ Request::is('department-manager/view/patients') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('department-manager/add/appointment') || Request::is('department-manager/view/appointments') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-calendar-check-o"></i> <span> Appointments </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/view/doctors')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_add_appointment') }}" class="{{ Request::is('department-manager/add/appointment') ? 'active' : '' }}">Add</a>
                        </li>

                        <li>
                            <a href="{{ route('department_manager_view_appointments') }}" class="{{ Request::is('department-manager/view/appointments') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <ul>
                <li class="menu-title">Medical Operations</li>

                <li class="submenu {{ Request::is('department-manager/view/prescriptions') || Request::is('department-manager/prescription_items/*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-file-medical"></i> <span> Prescriptions </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/view/prescriptions') || Request::is('department-manager/prescription_items/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_view_prescriptions') }}" class="{{ Request::is('department-manager/view/prescriptions') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('department-manager/view/patients-insurances') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Patients Insurances </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/view/patients-insurances') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('department_manager_view_patients_insurances') }}" class="{{ Request::is('department-manager/view/patients-insurances') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

            </ul>


            <ul>
                <li class="menu-title">Department Reports</li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-chart-line"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="">View Reports</a></li>
                    </ul>
                </li>

            </ul>




            <ul>
                <li class="menu-title">System</li>

                <li class="submenu {{ Request::is('department-manager/edit/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('department-manager/edit/profile') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('edit_profile') }}"
                               class="{{ Request::is('department-manager/edit/profile') ? 'active' : '' }}">
                               Edit My Profile
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
