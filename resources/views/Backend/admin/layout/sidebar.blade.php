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

                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="submenu {{ Request::is('admin/clinic/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-hospital"></i> <span> Clinic </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/clinic/profile')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('clinic_profile') }}" class="{{ Request::is('admin/clinic/profile') ? 'active' : '' }}">Profile</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu
                    {{ Request::is('admin/add/department')
                    || Request::is('admin/view/departments')
                    || Request::is('admin/edit/department/*')
                    || Request::is('admin/details/department/*')
                    || Request::is('admin/view/departments-managers')
                    || Request::is('admin/profile/department-manager/*')
                    || Request::is('admin/edit/department-manager/*')
                    ? 'active' : '' }}">

                    <a href="#">
                        <i class="fas fa-building"></i>
                        <span> Departments </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ Request::is('admin/add/department')
                        || Request::is('admin/view/departments')
                        || Request::is('admin/edit/department/*')
                        || Request::is('admin/details/department/*')
                        || Request::is('admin/view/departments-managers')
                        || Request::is('admin/profile/department-manager/*')
                        || Request::is('admin/edit/department-manager/*')
                        ? '' : 'display: none;' }}">

                        {{-- إضافة قسم جديد --}}
                        <li>
                            <a href="{{ route('add_department') }}"
                            class="{{ Request::is('admin/add/department') ? 'active' : '' }}">
                                Add Department
                            </a>
                        </li>

                        {{-- عرض الأقسام --}}
                        <li>
                            <a href="{{ route('view_departments') }}"
                            class="{{ Request::is('admin/view/departments')
                            || Request::is('admin/edit/department/*')
                            || Request::is('admin/details/department/*') ? 'active' : '' }}">
                                View Departments
                            </a>
                        </li>

                        {{-- مدراء الأقسام --}}
                        <li>
                            <a href="{{ route('view_departments_managers') }}"
                            class="{{ Request::is('admin/view/departments-managers')
                            || Request::is('admin/profile/department-manager/*')
                            || Request::is('admin/edit/department-manager/*') ? 'active' : '' }}">
                                Departments Managers
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('admin/add/specialty') || Request::is('admin/view/specialties') || Request::is('admin/edit/specialty/*') || Request::is('admin/details/specialty/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-stethoscope"></i> <span> Specialties </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/specialty') || Request::is('admin/view/specialties') || Request::is('admin/edit/specialty/*') || Request::is('admin/details/specialty/*')  ? '' : 'display: none;' }}">

                        <li>
                            <a href="{{ route('add_specialty') }}" class="{{ Request::is('admin/add/specialty') ? 'active' : '' }}">
                                Add Specialty
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('view_specialties') }}" class="{{ Request::is('admin/view/specialties') || Request::is('admin/edit/specialty/*') || Request::is('admin/details/specialty/*') ? 'active' : '' }}">
                                View Specialties
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="submenu {{ Request::is('admin/add/employee') || Request::is('admin/view/employees') || Request::is('admin/edit/employee/*') || Request::is('admin/profile/employee/*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ Request::is('admin/add/employee') || Request::is('admin/view/employees') || Request::is('admin/edit/employee/*') || Request::is('admin/profile/employee/*') ? '' : 'display: none;' }}">

                        <li>
                            <a href="{{ route('add_employee') }}"
                               class="{{ Request::is('admin/add/employee') ? 'active font-weight-bold' : '' }}">
                                Add Employee
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('view_employees') }}"
                               class="{{ Request::is('admin/view/employees') || Request::is('admin/edit/employee/*') || Request::is('admin/profile/employee/*') ? 'active font-weight-bold' : '' }}">
                                View Employees
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="submenu {{ Request::is('admin/add/doctor') || Request::is('admin/view/doctors') || Request::is('admin/edit/doctor/*') || Request::is('admin/profile/doctor/*')  || Request::is('admin/search/doctor/schedules') ? 'active' : '' }}">
                    <a href="#"><i class="fa-solid fa-user-doctor"></i> <span> Doctors </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/doctor') || Request::is('admin/view/doctors') || Request::is('admin/edit/doctor/*') || Request::is('admin/profile/doctor/*')  || Request::is('admin/search/doctor/schedules') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_doctor') }}" class="{{ Request::is('admin/add/doctor') ? 'active' : '' }}">Add Doctor</a>
                        </li>
                        <li>
                            <a href="{{ route('view_doctors') }}" class="{{ Request::is('admin/view/doctors') || Request::is('admin/edit/doctor/*') || Request::is('admin/profile/doctor/*') ? 'active' : '' }}">View Doctors</a>
                        </li>
                        <li>
                            <a href="{{ route('search_doctor_schedules') }}" class="{{ Request::is('admin/search/doctor/schedules') ? 'active' : '' }}">Doctor Schedules</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ Request::is('admin/add/patient') || Request::is('admin/view/patients') || Request::is('admin/edit/patient/*') || Request::is('admin/profile/patient/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-user-injured"></i> <span> Patients </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/patient') || Request::is('admin/view/patients') || Request::is('admin/edit/patient/*') || Request::is('admin/profile/patient/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_patient') }}" class="{{ Request::is('admin/add/patient') ? 'active' : '' }}">Add Patient</a>
                        </li>
                        <li>
                            <a href="{{ route('view_patients') }}" class="{{ Request::is('admin/view/patients') || Request::is('admin/edit/patient/*') || Request::is('admin/profile/patient/*') ? 'active' : '' }}">View Patients</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('admin/add/appointment') || Request::is('admin/view/appointments') || Request::is('admin/search/appointments') ||
                    Request::is('admin/edit/appointment/*') || Request::is('admin/details/appointment/*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-calendar-check-o"></i> <span> Appointments </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/appointment') || Request::is('admin/view/appointments') || Request::is('admin/search/appointments') ||
                        Request::is('admin/edit/appointment/*') || Request::is('admin/details/appointment/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_appointment') }}" class="{{ Request::is('admin/add/appointment') ? 'active' : '' }}">Add Appointment</a>
                        </li>
                        <li>
                            <a href="{{ route('view_appointments') }}"
                            class="{{ Request::is('admin/view/appointments') || Request::is('admin/search/appointments') || Request::is('admin/edit/appointment/*') || Request::is('admin/details/appointment/*') ? 'active' : '' }}">View Appointments</a>
                        </li>
                    </ul>
                </li>

            </ul>



            <ul>
                <li class="menu-title">Medical Operations</li>

                <li class="submenu {{ Request::is('admin/add/medication') || Request::is('admin/view/medications') || Request::is('admin/edit/medication/*') || Request::is('admin/details/medication/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-capsules"></i> <span> Medications </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/medication') || Request::is('admin/view/medications') || Request::is('admin/edit/medication/*') || Request::is('admin/details/medication/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_medication') }}" class="{{ Request::is('admin/add/medication') ? 'active' : '' }}">Add Medication</a>
                        </li>
                        <li>
                            <a href="{{ route('view_medications') }}" class="{{ Request::is('admin/view/medications') || Request::is('admin/edit/medication/*') || Request::is('admin/details/medication/*') ? 'active' : '' }}">View Medications</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('admin/view/pharmacy/inventory')
                    || Request::is('admin/search/pharmacy/inventory')
                    || Request::is('admin/add/medication/to/pharmacy')
                    || Request::is('admin/pharmacy/view') ? 'active' : '' }}">

                    <a href="#"><i class="fas fa-clinic-medical"></i>
                        <span> Pharmacy </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="{{ Request::is('admin/view/pharmacy/inventory')
                        || Request::is('admin/search/pharmacy/inventory')
                        || Request::is('admin/create/pharmacy/request')
                        || Request::is('admin/pharmacy/view') ? '' : 'display: none;' }}">

                        <li>
                            <a href="{{ route('view_pharmacy_inventory') }}"
                            class="{{ Request::is('admin/view/pharmacy/inventory') ? 'active' : '' }}">
                                View Pharmacy Inventory
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('create_pharmacy_request') }}"
                            class="{{ Request::is('admin/create/pharmacy/request') ? 'active' : '' }}">
                                Request Medication Supply
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('admin/view/prescriptions') || Request::is('admin/prescription_items/*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-file-medical"></i> <span> Prescriptions </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/view/prescriptions') || Request::is('admin/prescription_items/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('view_prescriptions') }}" class="{{ Request::is('admin/view/prescriptions') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Insurances </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ Route('add_insurance_provider') }}">Add Insurance</a></li>
                        <li><a href="{{ Route('view_insurances_providers') }}">View Insurances</a></li>

                        <li class="submenu">
                            <a href="#"><span> Patient Insurance </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{ Route('add_patient_insurance') }}">Add Patient Insurance</a></li>
                                <li><a href="{{ Route('view_patients_insurances') }}">View Patients Insurances</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"><span> Claims </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{ Route('add_claim') }}">Add Claim</a></li>
                                <li><a href="{{ Route('view_claims') }}">View Claims</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>


                <li class="submenu
                    {{ Request::is('admin/view/stock/inventory') || Request::is('admin/create/store/request') ? 'active' : '' }}">

                    <a href="#">
                        <i class="fas fa-warehouse"></i>
                        <span> Stock </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="{{ Request::is('admin/view/stock/inventory') || Request::is('admin/create/store/request') ? '' : 'display: none;' }}">

                        <li>
                            <a href="{{ route('view_stock_inventory') }}"
                            class="{{ Request::is('view/stock/inventory') ? 'active' : '' }}">
                                View Stock Inventory
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('create_store_request') }}"
                            class="{{ Request::is('admin/create/store/request') ? 'active' : '' }}">
                                Add Medication to Stock
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>


            <ul>
                <li class="menu-title">Invoices & Expenses</li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Invoices </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ Route('view_patients_invoices') }}">View Invoices</a></li>
                        <li><a href="{{ Route('view_patients_invoices_payments') }}">View Payments</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Expenses </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="">Add Expenses</a></li>
                        <li><a href="">View Expenses</a></li>
                    </ul>
                </li>

            </ul>



            <ul>
                <li class="menu-title">Reports & Analytics</li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-chart-line"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="">View Reports</a></li>
                        <li><a href="">Add Reports</a></li>
                    </ul>
                </li>

            </ul>



            <ul>
                <li class="menu-title">System</li>

                <li class="submenu {{ Request::is('admin/edit/clinic/profile') || Request::is('admin/edit/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/edit/clinic/profile') || Request::is('admin/edit/profile') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('edit_clinic_profile') }}"
                               class="{{ Request::is('admin/edit/clinic/profile') ? 'active' : '' }}">
                               Edit Clinic Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('edit_profile') }}"
                               class="{{ Request::is('admin/edit/profile') ? 'active' : '' }}">
                               Edit My Profile
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>


        </div>
    </div>
</div>
