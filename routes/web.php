<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\Admin\DoctorController;
use App\Http\Controllers\Backend\Admin\PatientController;
use App\Http\Controllers\Backend\Admin\EmployeeController;
use App\Http\Controllers\Backend\Admin\PharmacyController;
use App\Http\Controllers\Backend\Admin\ClinicInfoController;
use App\Http\Controllers\Backend\Admin\DepartmentController;
use App\Http\Controllers\Backend\Admin\MedicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Admin\AppointmentController;
use App\Http\Controllers\Backend\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Backend\Admin\PrescriptionController;
use App\Http\Controllers\Backend\Admin\MedicationStockController;
use App\Http\Controllers\Backend\Admin\MedicationRequestController;
use App\Http\Controllers\Backend\Employee\StoreSupervisor\RequestController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Backend\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Backend\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\Backend\Employee\Nurse\DashboardController as NurseDashboardController;
use App\Http\Controllers\Backend\DepartmentManager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Backend\Employee\Accountant\DashboardController as AccountantDashboardController;
use App\Http\Controllers\Backend\Employee\Receptionist\DashboardController as ReceptionistDashboardController;
use App\Http\Controllers\Backend\Employee\StoreSupervisor\DashboardController as StoreSupervisorDashboardController;
use App\Http\Controllers\Backend\Employee\StoreSupervisor\NotificationController as StoreSupervisorNotificationController;

Route::prefix('clinic-management')->group(function () {

    //Home
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::post('/contact', [HomeController::class, 'send'])->name('contact_send');


    //Auth
    Route::get('/login', [AuthenticatedSessionController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/user/login', [AuthenticatedSessionController::class, 'userLogin'])->name('user_login')->middleware('guest');
    Route::get('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register')->middleware('guest');

});


//Admin
Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {

    //Clinic Profile
    Route::get('/clinic/profile', [ClinicInfoController::class, 'clinicprofile'])->name('clinic_profile');
    Route::get('/edit/clinic/profile' , [ClinicInfoController::class , 'editClinicProfile'])->name('edit_clinic_profile');
    Route::put('/update/clinic/profile' , [ClinicInfoController::class , 'updateClinicProfile'])->name('update_clinic_profile');


    //Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/my_profile' , [AdminDashboardController::class , 'myProfile'])->name('my_profile');
    Route::get('/edit/profile' , [AdminDashboardController::class , 'editProfile'])->name('edit_profile');
    Route::put('/update/profile' , [AdminDashboardController::class , 'updateProfile'])->name('update_profile');


    //Department
    Route::get('/add/department' ,[DepartmentController::class , 'addDepartment'])->name('add_department');
    Route::post('/store/department' ,[DepartmentController::class , 'storeDepartment'])->name('store_department');
    Route::get('/view/departments' ,[DepartmentController::class , 'viewDepartments'])->name('view_departments');
    Route::get('/description/department/{id}' ,[DepartmentController::class , 'descriptionDepartment'])->name('description_department');
    Route::get('/edit/department/{id}' ,[DepartmentController::class , 'editDepartment'])->name('edit_department');
    Route::put('/update/department/{id}' ,[DepartmentController::class , 'updateDepartment'])->name('update_department');
    Route::delete('/delete/department/{id}' ,[DepartmentController::class , 'deleteDepartment'])->name('delete_department');

    Route::get('/view/departments-managers', [DepartmentController::class, 'viewDepartmentsManagers'])->name('view_departments_managers');
    Route::get('/profile/department-manager/{id}',[DepartmentController::class , 'profileDepartmentManager'])->name('profile_department_manager');
    Route::get('/edit/department-manager/{id}' ,[DepartmentController::class , 'editDepartmentManager'])->name('edit_department_manager');
    Route::put('/update/department-manager/{id}' ,[DepartmentController::class , 'updateDepartmentManager'])->name('update_department_manager');
    Route::delete('/delete/department-manager/{id}' ,[DepartmentController::class , 'deleteDepartmentManager'])->name('delete_department_manager');


    //Employee
    Route::get('/add/employee' ,[EmployeeController::class , 'addEmployee'])->name('add_employee');
    Route::post('/store/employee',[EmployeeController::class , 'storeEmployee'])->name('store_employee');
    Route::get('/view/employees' ,[EmployeeController::class , 'viewEmployees'])->name('view_employees');
    Route::get('/search/employees',[EmployeeController::class , 'searchEmployees'])->name('search_employees');
    Route::get('/profile/employee/{id}',[EmployeeController::class , 'profileEmployee'])->name('profile_employee');
    Route::get('/edit/employee/{id}' ,[EmployeeController::class , 'editEmployee'])->name('edit_employee');
    Route::put('/update/employee/{id}' ,[EmployeeController::class , 'updateEmployee'])->name('update_employee');
    Route::delete('/delete/employee/{id}' ,[EmployeeController::class , 'deleteEmployee'])->name('delete_employee');


    //Doctor
    Route::get('/add/doctor' ,[DoctorController::class , 'addDoctor'])->name('add_doctor');
    Route::post('/store/doctor',[DoctorController::class , 'storeDoctor'])->name('store_doctor');
    Route::get('/view/doctors' ,[DoctorController::class , 'viewDoctors'])->name('view_doctors');
    Route::get('/search/doctors',[DoctorController::class , 'searchDoctors'])->name('search_doctors');
    Route::get('/profile/doctor/{id}',[DoctorController::class , 'profileDoctor'])->name('profile_doctor');
    Route::get('/edit/doctor/{id}' ,[DoctorController::class , 'editDoctor'])->name('edit_doctor');
    Route::put('/update/doctor/{id}' ,[DoctorController::class , 'updateDoctor'])->name('update_doctor');
    Route::delete('/delete/doctor/{id}' ,[DoctorController::class , 'deleteDoctor'])->name('delete_doctor');

    Route::get('/search/doctor/schedules',[DoctorController::class ,  'searchDoctorSchedules']);
    Route::post('/search/doctor/schedules',[DoctorController::class , 'searchDoctchedules'])->name('search_doctor_schedules');


    //Patient
    Route::get('/add/patient' ,[PatientController::class , 'addPatient'])->name('add_patient');
    Route::post('/store/patient',[PatientController::class , 'storePatient'])->name('store_patient');
    Route::get('/view/patients' ,[PatientController::class , 'viewPatients'])->name('view_patients');
    Route::get('/search/patients' ,[PatientController::class , 'searchPatients'])->name('search_patients');
    Route::get('/profile/patient/{id}',[PatientController::class , 'profilePatient'])->name('profile_patient');
    Route::get('/edit/patient/{id}' ,[PatientController::class , 'editPatient'])->name('edit_patient');
    Route::put('/update/patient/{id}' ,[PatientController::class , 'updatePatient'])->name('update_patient');
    Route::delete('/delete/patient/{id}' ,[PatientController::class , 'deletePatient'])->name('delete_patient');

    Route::get('/get-doctors-by-department/{department_id}', [PatientController::class, 'getDoctorsByDepartment']);
    Route::get('/get-doctor-info/{id}', [PatientController::class, 'getDoctorInfo']);
    Route::get('/doctor-working-days/{id}', [PatientController::class, 'getWorkingDays']);


    //Appointment
    Route::get('/add/appointment' ,[AppointmentController::class , 'addAppointment'])->name('add_appointment');
    Route::post('/store/appointment',[AppointmentController::class , 'storeAppointment'])->name('store_appointment');
    Route::get('/view/appointments' ,[AppointmentController::class , 'viewAppointments'])->name('view_appointments');
    Route::get('/search/appointments',[AppointmentController::class , 'searchAppointments'])->name('search_appointments');
    Route::get('/description/appointment/{id}',[AppointmentController::class , 'descriptionAppointment'])->name('description_appointment');
    Route::get('/edit/appointment/{id}' ,[AppointmentController::class , 'editAppointment'])->name('edit_appointment');
    Route::put('/update/appointment/{id}' ,[AppointmentController::class , 'updateAppointment'])->name('update_appointment');
    Route::delete('/delete/appointment/{id}' ,[AppointmentController::class ,'deleteAppointment'])->name('delete_appointment');

    Route::get('/search/patients', [PatientController::class, 'searchPatients'])->name('search_patients');


    //Pharmacy
    Route::get('/view/pharmacy/inventory', [PharmacyController::class, 'viewPharmacyInventory'])->name('view_pharmacy_inventory');
    Route::get('/search/pharmacy/inventory',[PharmacyController::class , 'searchPharmacyInventory'])->name('search_pharmacy_inventory');

    Route::get('/pharmacy/view', [PharmacyController::class, 'pharmacyView'])->name('pharmacy_view'); // عدل هنا


    //Medication
    Route::get('/add/medication' ,[MedicationController::class , 'addMedication'])->name('add_medication');
    Route::post('/store/medication',[MedicationController::class , 'storeMedication'])->name('store_medication');
    Route::get('/view/medications' ,[MedicationController::class , 'viewMedications'])->name('view_medications');
    Route::get('/search/medications',[MedicationController::class , 'searchMedications'])->name('search_medications');
    Route::get('/description/medication/{id}',[MedicationController::class , 'descriptionMedication'])->name('description_medication');
    Route::get('/edit/medication/{id}' ,[MedicationController::class , 'editMedication'])->name('edit_medication');
    Route::put('/update/medication/{id}' ,[MedicationController::class , 'updateMedication'])->name('update_medication');
    Route::delete('/medication/{id}' ,[MedicationController::class , 'deleteMedication'])->name('delete_medication');

    //Trashed Medication
    Route::get('/view/trashed/medications', [MedicationController::class, 'viewTrashedMedications'])->name('view_trashed_medications');
    Route::get('/search/trashed/medications',[MedicationController::class , 'searchTrashedMedications'])->name('search_trashed_medications');
    Route::post('/restore/medication/{id}', [MedicationController::class, 'restoreMedication'])->name('restore_medication');
    Route::delete('/medication/force-delete/{id}', [MedicationController::class, 'forceDeleteMedication'])->name('force_delete_medication');
    Route::delete('/medications/remove-all', [MedicationController::class, 'forceDeleteAllMedications'])->name('force_delete_all_medications');

    //Prescription
    Route::get('/view/prescriptions' ,[PrescriptionController::class , 'viewPrescriptions'])->name('view_prescriptions');
    Route::get('/description/prescription/{id}',[PrescriptionController::class , 'descriptionPrescription'])->name('description_prescription');


    //Stock
    // Route::get('/add/medication/to/Stock' ,[MedicationStockController::class , 'addMedicationToStock'])->name('add_medication_to_stock');
    // Route::post('/store/medication/to/Stock',[MedicationStockController::class , 'storeMedicationToStock'])->name('store_medication_to_stock');
    // Route::get('/generate-batch-number',[MedicationStockController::class , 'generateBatchNumber'])->name('generate_batch_number');
    Route::get('/view/stock' ,[MedicationStockController::class , 'viewStock'])->name('view_stock');

    // Route::get('/description/stock/{id}',[MedicationStockController::class , 'descriptionStock'])->name('description_stock');
    // Route::get('/edit/stock/{id}' ,[MedicationStockController::class , 'editStock'])->name('edit_stock');
    // Route::put('/update/stock/{id}' ,[MedicationStockController::class , 'updateStock'])->name('update_stock');
    // Route::delete('/delete/stock/{id}' ,[MedicationStockController::class , 'deleteStock'])->name('delete_stock');


    //Medication Requests
    Route::get('/add/medication/request', [MedicationRequestController::class, 'addMedicationRequest'])->name('add_medication_request');
    Route::post('/store/medication/request', [MedicationRequestController::class, 'storeMedicationRequest'])->name('store_medication_request');
    Route::get('/medication/requests', [MedicationRequestController::class, 'index'])->name('medication_requests');
    Route::post('/medication/request/{id}/approve', [MedicationRequestController::class, 'approve'])->name('approve_medication_request');
    Route::post('/medication/request/{id}/reject', [MedicationRequestController::class, 'reject'])->name('reject_medication_request');


    //***Finance***//

    //patient invoice
    // Route::get('/view/invoices' ,[PatientInvoiceController::class , 'viewInvoices'])->name('view_invoices');
    // Route::get('/details/invoice/{id}' ,[PatientInvoiceController::class , 'detailsInvoice'])->name('details_invoice');
    // Route::get('/edit/invoice/{id}' ,[PatientInvoiceController::class , 'editInvoice'])->name('edit_invoice');
    // Route::put('/update/invoice/{id}' ,[PatientInvoiceController::class , 'updateInvoice'])->name('update_invoice');
    // Route::delete('/delete/invoice/{id}' ,[PatientInvoiceController::class , 'deleteInvoice'])->name('delete_invoice');


    // //patient payment
    // Route::get('/view/payments' ,[PaymentController::class , 'viewPayments'])->name('view_payments');
    // Route::get('/details/payment/{id}' ,[PaymentController::class , 'detailsPayment'])->name('details_payment');
    // Route::get('/edit/payment/{id}' ,[PaymentController::class , 'editPayment'])->name('edit_payment');
    // Route::put('/update/payment/{id}' ,[PaymentController::class , 'updatePayment'])->name('update_payment');
    // Route::delete('/delete/payment/{id}' ,[PaymentController::class , 'deletePayment'])->name('delete_payment');

    // Route::get('/edit/payment/Details/{id}' ,[PaymentController::class , 'editPaymentDetails'])->name('edit_payment_Details');
    // Route::put('/update/payment/Details/{id}' ,[PaymentController::class , 'updatePaymentDetails'])->name('update_payment_Details');
    // Route::delete('/delete/payment/Details/{id}' ,[PaymentController::class , 'deletePaymentDetails'])->name('delete_payment_Details');


    // //vendor invoice
    // Route::get('/view/vendors/invoices' ,[VendorInvoiceController::class , 'viewVendorInvoices'])->name('view_vendors_invoices');
    // Route::get('/details/vendor/invoice/{id}' ,[VendorInvoiceController::class , 'detailsVendorInvoice'])->name('details_vendor_invoice');
    // Route::get('/edit/vendor/invoice/{id}' ,[VendorInvoiceController::class , 'editVendorInvoice'])->name('edit_vendor_invoice');
    // Route::put('/update/vendor/invoice/{id}' ,[VendorInvoiceController::class , 'updateVendorInvoice'])->name('update_vendor_invoice');
    // Route::delete('/delete/vendor/invoice/{id}' ,[VendorInvoiceController::class , 'deleteVendorInvoice'])->name('delete_vendor_invoice');


    // //expense
    // Route::get('/view/expenses' ,[ExpenseController::class , 'viewExpenses'])->name('view_expenses');
    // Route::get('/details/expense/{id}' ,[ExpenseController::class , 'detailsExpense'])->name('details_expense');
    // Route::get('/edit/expense/{id}' ,[ExpenseController::class , 'editExpense'])->name('edit_expense');
    // Route::put('/update/expense/{id}' ,[ExpenseController::class , 'updateExpense'])->name('update_expense');
    // Route::delete('/delete/expense/{id}' ,[ExpenseController::class , 'deleteExpense'])->name('delete_expense');

    // Route::get('/edit/expense/Details/{id}' ,[ExpenseController::class , 'editExpenseDetails'])->name('edit_expense_Details');
    // Route::put('/update/expense/Details/{id}' ,[ExpenseController::class , 'updateExpenseDetails'])->name('update_expense_Details');
    // Route::delete('/delete/expense/Details/{id}' ,[ExpenseController::class , 'deleteExpenseDetails'])->name('delete_expense_Details');


    // //Reports
    // Route::get('/view/reports' ,[ReportController::class , 'viewReports'])->name('view_reports');

    // Notifications
    Route::get('/notifications/read/{id}', [AdminNotificationController::class, 'markAsRead'])->name('notifications.read');

});





//Department Manager
Route::prefix('department-manager')->middleware(['auth', 'verified', 'role:department_manager'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [ManagerDashboardController::class, 'departmentManagerDashboard'])->name('department_manager_dashboard');
    Route::get('/profile' , [ManagerDashboardController::class , 'departmentManagerProfile'])->name('department_manager_profile');
    Route::get('/edit/profile' , [ManagerDashboardController::class , 'departmentManagerEditProfile'])->name('department_manager_edit_profile');
    Route::put('/update/profile' , [ManagerDashboardController::class , 'departmentManagerUpdateProfile'])->name('department_manager_update_profile');




});





//Doctor
Route::prefix('doctor')->middleware(['auth', 'verified', 'role:doctor'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [DoctorDashboardController::class, 'doctorDashboard'])->name('doctor_dashboard');
    Route::get('/profile' , [DoctorDashboardController::class , 'doctorProfile'])->name('doctor_profile');
    Route::get('/edit/profile' , [DoctorDashboardController::class , 'doctorEditProfile'])->name('doctor_edit_profile');
    Route::put('/update/profile' , [DoctorDashboardController::class , 'doctorUpdateProfile'])->name('doctor_update_profile');




});





//Employees
/** Accountants **/
Route::prefix('employee/accountant')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [AccountantDashboardController::class, 'accountantDashboard'])->name('accountant_dashboard');
    Route::get('/profile' , [AccountantDashboardController::class , 'accountantProfile'])->name('accountant_profile');
    Route::get('/edit/profile' , [AccountantDashboardController::class , 'accountantEditProfile'])->name('accountant_edit_profile');
    Route::put('/update/profile' , [AccountantDashboardController::class , 'accountantUpdateProfile'])->name('accountant_update_profile');




});



/** Nurses **/
Route::prefix('employee/nurse')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [NurseDashboardController::class, 'nurseDashboard'])->name('nurse_dashboard');
    Route::get('/profile' , [NurseDashboardController::class , 'nurseProfile'])->name('nurse_profile');
    Route::get('/edit/profile' , [NurseDashboardController::class , 'nurseEditProfile'])->name('nurse_edit_profile');
    Route::put('/update/profile' , [NurseDashboardController::class , 'nurseUpdateProfile'])->name('nurse_update_profile');




});



/** Receptionists **/
Route::prefix('employee/receptionist')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [ReceptionistDashboardController::class, 'receptionistDashboard'])->name('receptionist_dashboard');
    Route::get('/profile' , [ReceptionistDashboardController::class , 'receptionistProfile'])->name('receptionist_profile');
    Route::get('/edit/profile' , [ReceptionistDashboardController::class , 'receptionistEditProfile'])->name('receptionist_edit_profile');
    Route::put('/update/profile' , [ReceptionistDashboardController::class , 'receptionistUpdateProfile'])->name('receptionist_update_profile');




});



/** StoreSupervisors **/
Route::prefix('employee/store-supervisor')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [StoreSupervisorDashboardController::class, 'storeSupervisorDashboard'])->name('store_supervisor_dashboard');
    Route::get('/profile' , [StoreSupervisorDashboardController::class , 'storeSupervisorProfile'])->name('store_supervisor_profile');
    Route::get('/edit/profile' , [StoreSupervisorDashboardController::class , 'storeSupervisorEditProfile'])->name('store_supervisor_edit_profile');
    Route::put('/update/profile' , [StoreSupervisorDashboardController::class , 'storeSupervisorUpdateProfile'])->name('store_supervisor_update_profile');

    Route::get('/view/requests', [RequestController::class, 'viewRequests'])->name('view_requests');
    Route::post('/medication-requests/{id}/approve', [RequestController::class, 'approve'])->name('medication_request_approve');
    Route::get('/view/reject/{id}', [RequestController::class, 'viewReject'])->name('view_reject');
    Route::post('/medication-requests/{id}/reject', [RequestController::class, 'reject'])->name('medication_request_reject');
    Route::get('/request/description/{id}', [RequestController::class, 'requestDescription'])->name('request_description');



    // Notifications
    Route::get('/notifications/read/{id}', [StoreSupervisorNotificationController::class, 'markAsRead'])->name('notifications.read');

});





Route::prefix('patient')->middleware(['auth', 'verified', 'role:patient'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [PatientDashboardController::class, 'patientDashboard'])->name('patient_dashboard');
    Route::get('/profile' , [PatientDashboardController::class , 'patientProfile'])->name('patient_profile');
    Route::get('/edit/profile' , [PatientDashboardController::class , 'patientEditProfile'])->name('patient_edit_profile');
    Route::put('/update/profile' , [PatientDashboardController::class , 'patientUpdateProfile'])->name('patient_update_profile');




});
