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
                    || Request::is('admin/description/department/*')
                    || Request::is('admin/view/departments-managers')
                    || Request::is('admin/profile/department-manager/*')
                    || Request::is('admin/edit/department-manager/*')
                    ? 'active' : '' }}">

                    <a href="#">
                        <i class="fas fa-stethoscope"></i>
                        <span> Departments </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ Request::is('admin/add/department')
                        || Request::is('admin/view/departments')
                        || Request::is('admin/edit/department/*')
                        || Request::is('admin/description/department/*')
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
                            || Request::is('admin/description/department/*') ? 'active' : '' }}">
                                View Department
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
                    Request::is('admin/edit/appointment/*') || Request::is('admin/description/appointment/*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-calendar-check-o"></i> <span> Appointments </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/appointment') || Request::is('admin/view/appointments') || Request::is('admin/search/appointments') ||
                        Request::is('admin/edit/appointment/*') || Request::is('admin/description/appointment/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_appointment') }}" class="{{ Request::is('admin/add/appointment') ? 'active' : '' }}">Add Appointment</a>
                        </li>
                        <li>
                            <a href="{{ route('view_appointments') }}"
                            class="{{ Request::is('admin/view/appointments') || Request::is('admin/search/appointments') || Request::is('admin/edit/appointment/*') || Request::is('admin/description/appointment/*') ? 'active' : '' }}">View Appointments</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <ul>
                <li class="menu-title">Medical Operations</li>

                <li class="submenu {{ Request::is('admin/pharmacy/profile') || Request::is('admin/pharmacy/view') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-clinic-medical"></i> <span> Pharmacy </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/pharmacy/profile') || Request::is('admin/pharmacy/view') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('pharmacy_profile') }}" class="{{ Request::is('admin/pharmacy/profile') ? 'active' : '' }}">Pharmacy Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('pharmacy_view') }}" class="{{ Request::is('admin/pharmacy/view') ? 'active' : '' }}">View Pharmacy</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ Request::is('admin/add/medication') || Request::is('admin/view/medications') || Request::is('admin/edit/medication/*') || Request::is('admin/description/medication/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-capsules"></i> <span> Medications </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/medication') || Request::is('admin/view/medications') || Request::is('admin/edit/medication/*') || Request::is('admin/description/medication/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_medication') }}" class="{{ Request::is('admin/add/medication') ? 'active' : '' }}">Add Medication</a>
                        </li>
                        <li>
                            <a href="{{ route('view_medications') }}" class="{{ Request::is('admin/view/medications') || Request::is('admin/edit/medication/*') || Request::is('admin/description/medication/*') ? 'active' : '' }}">View Medications</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ Request::is('admin/view/prescriptions') || Request::is('admin/prescription_items/*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-file-medical"></i> <span> Prescriptions </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/view/prescriptions') || Request::is('admin/prescription_items/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('view_prescriptions') }}" class="{{ Request::is('admin/view/prescriptions') ? 'active' : '' }}">View Prescriptions</a>
                        </li>
                    </ul>
                </li>


                <li class="submenu {{ Request::is('admin/add/toStock') || Request::is('admin/view/stocks') || Request::is('admin/expired/alerts') || Request::is('admin/edit/stock/*') || Request::is('admin/description/stock/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-warehouse"></i> <span> Stock </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/toStock') || Request::is('admin/view/stocks') || Request::is('admin/expired/alerts') || Request::is('admin/edit/stock/*') || Request::is('admin/description/stock/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_to_stock') }}" class="{{ Request::is('admin/add/toStock') ? 'active' : '' }}">Add Stock</a>
                        </li>
                        <li>
                            <a href="{{ route('view_stocks') }}" class="{{ Request::is('admin/view/stocks') || Request::is('admin/edit/stock/*') || Request::is('admin/description/stock/*') ? 'active' : '' }}">View Stock</a>
                        </li>
                    </ul>
                </li>
            </ul>


            {{-- <ul>
                <li class="menu-title">Administration</li>

                <li class="submenu {{
                    Request::is('admin/view/invoices') ||
                    Request::is('admin/details/invoice/*') ||
                    Request::is('admin/edit/invoice/*') ||
                    Request::is('admin/view/payments') ||
                    Request::is('admin/details/payment/*') ||
                    Request::is('admin/edit/payment/*') ||
                    Request::is('admin/edit/payment/Details/*') ||
                    Request::is('admin/view/vendors/invoices') ||
                    Request::is('admin/details/vendor/invoice/*') ||
                    Request::is('admin/edit/vendor/invoice/*') ||
                    Request::is('admin/view/expenses') ||
                    Request::is('admin/details/expense/*') ||
                    Request::is('admin/edit/expense/*') ||
                    Request::is('admin/edit/expense/Details/*')
                    ? 'active' : '' }}">

                    <a href="#"><i class="fa fa-money"></i> <span> Finance </span> <span class="menu-arrow"></span></a>

                    <ul style="{{
                        Request::is('admin/view/invoices') ||
                        Request::is('admin/details/invoice/*') ||
                        Request::is('admin/edit/invoice/*') ||
                        Request::is('admin/view/payments') ||
                        Request::is('admin/details/payment/*') ||
                        Request::is('admin/edit/payment/*') ||
                        Request::is('admin/edit/payment/Details/*') ||
                        Request::is('admin/view/vendors/invoices') ||
                        Request::is('admin/details/vendor/invoice/*') ||
                        Request::is('admin/edit/vendor/invoice/*') ||
                        Request::is('admin/view/expenses') ||
                        Request::is('admin/details/expense/*') ||
                        Request::is('admin/edit/expense/*') ||
                        Request::is('admin/edit/expense/Details/*')
                        ? '' : 'display: none;' }}">

                        <li>
                            <a href="{{ route('view_invoices') }}"
                                class="{{ Request::is('admin/view/invoices') || Request::is('admin/details/invoice/*') || Request::is('admin/edit/invoice/*') ? 'active' : '' }}">
                                Patient Invoices
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view_payments') }}"
                                class="{{ Request::is('admin/view/payments') || Request::is('admin/details/payment/*') || Request::is('admin/edit/payment/*') || Request::is('admin/edit/payment/Details/*') ? 'active' : '' }}">
                                Patient Payments
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view_vendors_invoices') }}"
                                class="{{ Request::is('admin/view/vendors/invoices') || Request::is('admin/details/vendor/invoice/*') || Request::is('admin/edit/vendor/invoice/*') ? 'active' : '' }}">
                                Vendor Invoices
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view_expenses') }}"
                                class="{{ Request::is('admin/view/expenses') || Request::is('admin/details/expense/*') || Request::is('admin/edit/expense/*') || Request::is('admin/edit/expense/Details/*') ? 'active' : '' }}">
                                Expenses
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ Request::is('admin/view/reports') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-file-alt"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/view/reports') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('view_reports') }}" class="{{ Request::is('admin/view/reports') ? 'active' : '' }}">View Reports</a>
                        </li>
                    </ul>
                </li>

            </ul> --}}

            <ul>
                <li class="menu-title">System</li>

                <li class="submenu {{ Request::is('admin/add/employee') || Request::is('admin/view/employees') || Request::is('admin/edit/employee/*') || Request::is('admin/profile/employee/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-cog"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('admin/add/employee') || Request::is('admin/view/employees') || Request::is('admin/edit/employee/*') || Request::is('admin/profile/employee/*') ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('add_employee') }}" class="{{ Request::is('admin/add/employee') ? 'active' : '' }}">Add Employee</a>
                        </li>
                        <li>
                            <a href="{{ route('view_employees') }}" class="{{ Request::is('admin/view/employees') || Request::is('admin/edit/employee/*') || Request::is('admin/profile/employee/*') ? 'active' : '' }}">View Employee</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
