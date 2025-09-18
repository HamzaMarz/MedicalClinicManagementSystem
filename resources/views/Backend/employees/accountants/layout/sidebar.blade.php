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

                <li class="{{ Request::is('employee/accountant/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('accountant_dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="submenu {{ Request::is('employee/accountant/profile') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-user-circle"></i> <span> My Profile </span> <span class="menu-arrow"></span></a>
                    <ul style="{{ Request::is('employee/accountant/profile')  ? '' : 'display: none;' }}">
                        <li>
                            <a href="{{ route('accountant_profile') }}" class="{{ Request::is('employee/accountant/profile') ? 'active' : '' }}">View</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu {{ Request::is('employee/accountant/view/employees') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ Request::is('employee/accountant/view/employees') ? '' : 'display: none;' }}">

                        <li>
                            <a href="{{ route('accountant_view_employees') }}"
                               class="{{ Request::is('employee/accountant/view/employees') ? 'active font-weight-bold' : '' }}">
                                View Employees
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>

            <ul>
                <li class="menu-title">Medical Operations</li>

                <li class="submenu {{ Request::is('employee/accountant/view/insurances') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-file-invoice-dollar"></i> <span> Insurances </span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ Request::is('employee/accountant/view/insurances') ? '' : 'display: none;' }}">

                        <li>
                            <a href="{{ route('accountant_view_insurances_providers') }}"
                               class="{{ Request::is('employee/accountant/view/insurances') ? 'active font-weight-bold' : '' }}">
                                View Insurances Providers
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('accountant_view_patients_insurances') }}"
                               class="{{ Request::is('employee/accountant/view/insurances') ? 'active font-weight-bold' : '' }}">
                                View Patients Insurances
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
                        <li><a href="{{ Route('accountant_view_patients_invoices') }}">View Invoices</a></li>
                        <li><a href="{{ Route('accountant_view_patients_invoices_payments') }}">View Payments</a></li>
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
                <li class="menu-title">System</li>



            </ul>
        </div>
    </div>
</div>
