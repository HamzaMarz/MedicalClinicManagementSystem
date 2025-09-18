<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\Admin\DoctorController;
use App\Http\Controllers\Backend\Admin\PatientController;
use App\Http\Controllers\Backend\Admin\EmployeeController;
use App\Http\Controllers\Backend\Admin\PharmacyController;
use App\Http\Controllers\Backend\Admin\InsuranceController;
use App\Http\Controllers\Backend\Admin\SpecialtyController as AdminSpecialtyController;
use App\Http\Controllers\Backend\Admin\ClinicInfoController;
use App\Http\Controllers\Backend\Admin\DepartmentController;
use App\Http\Controllers\Backend\Admin\MedicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Admin\AppointmentController;
use App\Http\Controllers\Backend\Admin\PrescriptionController;
use App\Http\Controllers\Backend\Admin\PatientInvoiceController;
use App\Http\Controllers\Backend\Admin\MedicationStockController;
use App\Http\Controllers\Backend\Admin\MedicationRequestController;
use App\Http\Controllers\Backend\Admin\PatientInvoicePaymentController;
use App\Http\Controllers\Backend\DepartmentManager\SpecialtyController as ManagerSpecialtyController;
use App\Http\Controllers\Backend\DepartmentManager\EmployeeController as ManagerEmployeeController;
use App\Http\Controllers\Backend\DepartmentManager\DoctorController as ManagerDoctorController;
use App\Http\Controllers\Backend\DepartmentManager\PatientController as ManagerPatientController;
use App\Http\Controllers\Backend\DepartmentManager\AppointmentController as ManagerAppointmentController;
use App\Http\Controllers\Backend\DepartmentManager\PrescriptionController as ManagerPrescriptionController;
use App\Http\Controllers\Backend\DepartmentManager\PatientInsuranceController as ManagerPatientInsuranceController;
use App\Http\Controllers\Backend\Employee\StoreSupervisor\RequestController;
use App\Http\Controllers\Backend\Doctor\PatientController as DoctorPatientController;
use App\Http\Controllers\Backend\Doctor\PrescriptionController as DoctorPrescriptionController;
use App\Http\Controllers\Backend\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Backend\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Backend\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\Backend\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Backend\Employee\Nurse\DashboardController as NurseDashboardController;
use App\Http\Controllers\Backend\DepartmentManager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Backend\Employee\Accountant\DashboardController as AccountantDashboardController;
use App\Http\Controllers\Backend\Employee\Pharmacist\DashboardController as pharmacistDashboardController;
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
    Route::get('/search/departments/managers',[DepartmentController::class , 'searchDepartmentsManagers'])->name('search_departments_managers');
    Route::get('/details/department/{id}' ,[DepartmentController::class , 'detailsDepartment'])->name('details_department');
    Route::get('/edit/department/{id}' ,[DepartmentController::class , 'editDepartment'])->name('edit_department');
    Route::put('/update/department/{id}' ,[DepartmentController::class , 'updateDepartment'])->name('update_department');
    Route::delete('/delete/department/{id}' ,[DepartmentController::class , 'deleteDepartment'])->name('delete_department');

    Route::get('/view/departments-managers', [DepartmentController::class, 'viewDepartmentsManagers'])->name('view_departments_managers');
    Route::get('/profile/department-manager/{id}',[DepartmentController::class , 'profileDepartmentManager'])->name('profile_department_manager');
    Route::get('/edit/department-manager/{id}' ,[DepartmentController::class , 'editDepartmentManager'])->name('edit_department_manager');
    Route::put('/update/department-manager/{id}' ,[DepartmentController::class , 'updateDepartmentManager'])->name('update_department_manager');
    Route::delete('/delete/department-manager/{id}' ,[DepartmentController::class , 'deleteDepartmentManager'])->name('delete_department_manager');


    //Specialty
    Route::get('/add/specialty' ,[AdminSpecialtyController::class , 'addSpecialty'])->name('add_specialty');
    Route::post('/store/specialty' ,[AdminSpecialtyController::class , 'storeSpecialty'])->name('store_specialty');
    Route::get('/view/specialties' ,[AdminSpecialtyController::class , 'viewSpecialties'])->name('view_specialties');
    Route::get('/details/specialty/{id}' ,[AdminSpecialtyController::class , 'detailsSpecialty'])->name('details_specialty');
    Route::get('/edit/specialty/{id}' ,[AdminSpecialtyController::class , 'editSpecialty'])->name('edit_specialty');
    Route::put('/update/specialty/{id}' ,[AdminSpecialtyController::class , 'updateSpecialty'])->name('update_specialty');
    Route::delete('/delete/specialty/{id}' ,[AdminSpecialtyController::class , 'deleteSpecialty'])->name('delete_specialty');


    //Employee
    Route::get('/add/employee' ,[EmployeeController::class , 'addEmployee'])->name('add_employee');
    Route::post('/store/employee',[EmployeeController::class , 'storeEmployee'])->name('store_employee');
    Route::get('/view/employees' ,[EmployeeController::class , 'viewEmployees'])->name('view_employees');
    Route::get('/search/employees',[EmployeeController::class , 'searchEmployees'])->name('search_employees');
    Route::get('/profile/employee/{id}',[EmployeeController::class , 'profileEmployee'])->name('profile_employee');
    Route::get('/edit/employee/{id}' ,[EmployeeController::class , 'editEmployee'])->name('edit_employee');
    Route::put('/update/employee/{id}' ,[EmployeeController::class , 'updateEmployee'])->name('update_employee');
    Route::delete('/delete/employee/{id}' ,[EmployeeController::class , 'deleteEmployee'])->name('delete_employee');
    Route::get('/get-specialties-by-department/{department_id}', [EmployeeController::class, 'getSpecialtiesByDepartment']);

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
    Route::get('/details/appointment/{id}',[AppointmentController::class , 'detailsAppointment'])->name('details_appointment');
    Route::get('/edit/appointment/{id}' ,[AppointmentController::class , 'editAppointment'])->name('edit_appointment');
    Route::put('/update/appointment/{id}' ,[AppointmentController::class , 'updateAppointment'])->name('update_appointment');
    Route::delete('/delete/appointment/{id}' ,[AppointmentController::class ,'deleteAppointment'])->name('delete_appointment');

    Route::get('/search/patients', [PatientController::class, 'searchPatients'])->name('search_patients');


    //Medication
    Route::get('/add/medication' ,[MedicationController::class , 'addMedication'])->name('add_medication');
    Route::post('/store/medication',[MedicationController::class , 'storeMedication'])->name('store_medication');
    Route::get('/view/medications' ,[MedicationController::class , 'viewMedications'])->name('view_medications');
    Route::get('/search/medications',[MedicationController::class , 'searchMedications'])->name('search_medications');
    Route::get('/details/medication/{id}',[MedicationController::class , 'detailsMedication'])->name('details_medication');
    Route::get('/edit/medication/{id}' ,[MedicationController::class , 'editMedication'])->name('edit_medication');
    Route::put('/update/medication/{id}' ,[MedicationController::class , 'updateMedication'])->name('update_medication');
    Route::delete('/medication/{id}' ,[MedicationController::class , 'deleteMedication'])->name('delete_medication');

    //Trashed Medication
    Route::get('/view/trashed/medications', [MedicationController::class, 'viewTrashedMedications'])->name('view_trashed_medications');
    Route::get('/search/trashed/medications',[MedicationController::class , 'searchTrashedMedications'])->name('search_trashed_medications');
    Route::post('/restore/medication/{id}', [MedicationController::class, 'restoreMedication'])->name('restore_medication');
    Route::delete('/medication/force-delete/{id}', [MedicationController::class, 'forceDeleteMedication'])->name('force_delete_medication');
    Route::delete('/medications/remove-all', [MedicationController::class, 'forceDeleteAllMedications'])->name('force_delete_all_medications');


    //Pharmacy
    Route::get('/view/pharmacy/inventory', [PharmacyController::class, 'viewPharmacyInventory'])->name('view_pharmacy_inventory');
    Route::get('/search/pharmacy/inventory',[PharmacyController::class , 'searchPharmacyInventory'])->name('search_pharmacy_inventory');


    //Prescription
    Route::get('/view/prescriptions' ,[PrescriptionController::class , 'viewPrescriptions'])->name('view_prescriptions');
    Route::get('/search/prescriptions',[PrescriptionController::class , 'searchPrescriptions'])->name('search_prescriptions');
    Route::get('/view/items/prescriptions/{id}',[PrescriptionController::class , 'viewItemsPrescriptions'])->name('view_items_prescription');
    Route::delete('/delete/prescription/{id}',[PrescriptionController::class , 'deletePrescription']);


    //Stock
    Route::get('/view/stock/inventory' ,[MedicationStockController::class , 'viewStockInventory'])->name('view_stock_inventory');
    Route::get('/stock/inventory/add', [MedicationStockController::class, 'stockInventoryAdd'])->name('stock_inventory_add');
    Route::post('/stock/inventory/store', [MedicationStockController::class, 'stockInventoryStore'])->name('stock_inventory_store');



    //Medication Requests
    Route::get('/create/pharmacy/request', [MedicationRequestController::class, 'createPharmacyRequest'])->name('create_pharmacy_request');
    Route::post('/store/pharmacy/request', [MedicationRequestController::class, 'storePharmacyRequest'])->name('store_pharmacy_request');

    Route::get('/create/store/request', [MedicationRequestController::class, 'createStoreRequest'])->name('create_store_request');
    Route::post('/store/store/request', [MedicationRequestController::class, 'storeStoreRequest'])->name('store_store_request');

    Route::get('/medication/requests', [MedicationRequestController::class, 'medicationRequests'])->name('medication_requests');

    Route::post('/medication/request/{id}/approve', [MedicationRequestController::class, 'approve'])->name('approve_medication_request');
    Route::post('/medication/request/{id}/reject', [MedicationRequestController::class, 'reject'])->name('reject_medication_request');



    //***Finance***//

    //Patient invoice
    Route::get('/view/patients/invoices' ,[PatientInvoiceController::class , 'viewPatientsInvoices'])->name('view_patients_invoices');
    Route::get('/search/patients/invoices', [PatientInvoiceController::class, 'searchPatientsInvoices'])->name('search_patients_invoices');
    Route::get('/details/patient/invoice/{id}' ,[PatientInvoiceController::class , 'detailsPatientInvoice'])->name('details_patient_invoice');
    Route::get('/edit/patient/invoice/{id}' ,[PatientInvoiceController::class , 'editPatientInvoice'])->name('edit_patient_invoice');
    Route::put('/update/patient/invoice/{id}' ,[PatientInvoiceController::class , 'updatePatientInvoice'])->name('update_patient_invoice');
    Route::delete('/delete/patient/invoice/{id}' ,[PatientInvoiceController::class , 'deletePatientInvoice'])->name('delete_patient_invoice');


    //Patient payment
    Route::get('/view/patients/invoices/payments' ,[PatientInvoicePaymentController::class , 'viewPatientsInvoicesPayments'])->name('view_patients_invoices_payments');
    Route::get('/details/patient/invoice/payment/{id}' ,[PatientInvoicePaymentController::class , 'detailsPatientInvoicePayment'])->name('details_patient_invoice_payment');
    Route::delete('/delete/patient/invoice/payment/{id}' ,[PatientInvoicePaymentController::class , 'deletePatientInvoicePayment'])->name('delete_patient_invoice_payment');

    Route::get('/edit/payment/details/{id}' ,[PatientInvoicePaymentController::class , 'editPaymentDetails'])->name('edit_payment_details');
    Route::put('/update/payment/details/{id}' ,[PatientInvoicePaymentController::class , 'updatePaymentDetails'])->name('update_payment_details');
    Route::delete('/delete/payment/details/{id}' ,[PatientInvoicePaymentController::class , 'deletePaymentDetails'])->name('delete_payment_details');


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



    // Insurance
    Route::get('/add/insurance-provider' ,[InsuranceController::class , 'addInsuranceProvider'])->name('add_insurance_provider');
    Route::post('/store/insurance-provider' ,[InsuranceController::class , 'storeInsuranceProvider'])->name('store_insurance_provider');
    Route::get('/view/insurances-providers' ,[InsuranceController::class , 'viewInsurancesProviders'])->name('view_insurances_providers');
    Route::get('/search/insurances-providers' ,[InsuranceController::class , 'searchInsurancesProviders'])->name('search_insurances_providers');
    Route::get('/details/insurance-provider/{id}' ,[InsuranceController::class , 'detailsInsuranceProvider'])->name('details_insurance_provider');
    Route::get('/edit/insurance-provider/{id}' ,[InsuranceController::class , 'editInsuranceProvider'])->name('edit_insurance_provider');
    Route::put('/update/insurance-provider/{id}' ,[InsuranceController::class , 'updateInsuranceProvider'])->name('update_insurance_provider');
    Route::delete('/delete/insurance-provider/{id}' ,[InsuranceController::class , 'deleteInsuranceProvider'])->name('delete_insurance_provider');



    // Patient Insurance
    Route::get('/add/patient-insurance' ,[InsuranceController::class , 'addPatientInsurance'])->name('add_patient_insurance');
    Route::post('/store/patient-insurance' ,[InsuranceController::class , 'storePatientInsurance'])->name('store_patient_insurance');
    Route::get('/view/patients-insurances' ,[InsuranceController::class , 'viewPatientsInsurances'])->name('view_patients_insurances');
    Route::get('/search/patients-insurances' ,[InsuranceController::class , 'searchPatientsInsurances'])->name('search_patients_insurances');
    Route::get('/details/patient-insurance/{id}' ,[InsuranceController::class , 'detailsPatientInsurance'])->name('details_patient_insurance');
    Route::get('/edit/patient-insurance/{id}' ,[InsuranceController::class , 'editPatientInsurance'])->name('edit_patient_insurance');
    Route::put('/update/patient-insurance/{id}' ,[InsuranceController::class , 'updatePatientInsurance'])->name('update_patient_insurance');
    Route::delete('/delete/patient-insurance/{id}' ,[InsuranceController::class , 'deleteInsuranceInsurance'])->name('delete_patient_insurance');


    // Cliams
    Route::get('/add/claim' ,[InsuranceController::class , 'addClaim'])->name('add_claim');
    Route::post('/store/claim' ,[InsuranceController::class , 'storeClaim'])->name('store_claim');
    Route::get('/view/claims' ,[InsuranceController::class , 'viewClaims'])->name('view_claims');
    Route::get('/search/claims' ,[InsuranceController::class , 'searchClaims'])->name('search_claims');
    Route::get('/details/claim/{id}' ,[InsuranceController::class , 'detailsClaim'])->name('details_claim');
    Route::get('/edit/claim/{id}' ,[InsuranceController::class , 'editClaim'])->name('edit_claim');
    Route::put('/update/claim/{id}' ,[InsuranceController::class , 'updateClaim'])->name('update_claim');
    Route::delete('/delete/claim/{id}' ,[InsuranceController::class , 'deleteClaim'])->name('delete_claim');


    // //Reports
    // Route::get('/view/reports' ,[ReportController::class , 'viewReports'])->name('view_reports');

    // Notifications


    Route::get('/notifications/description/medication/read/{id}', [AdminNotificationController::class, 'markExpiredAsRead'])
    ->name('notifications_description_medication_read');   // إشعار الأدوية المنتهية

    Route::get('/notifications/description/read/{id}', [AdminNotificationController::class, 'markDescriptionAsRead'])
    ->name('notifications_description_read');  // إشعار موافقة/رفض  طلب

    // Route::get('/notifications/description/rejected/read/{id}', [AdminNotificationController::class, 'markRejectedAsRead'])
    // ->name('notifications_description_rejected_read');   // إشعار رفض الطلب
});





//Department Manager
Route::prefix('department-manager')->name('department_manager_')->middleware(['auth', 'verified', 'role:department_manager'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [ManagerDashboardController::class, 'departmentManagerDashboard'])->name('dashboard');
    Route::get('/profile' , [ManagerDashboardController::class , 'departmentManagerProfile'])->name('profile');
    Route::get('/edit/profile' , [ManagerDashboardController::class , 'departmentManagerEditProfile'])->name('edit_profile');
    Route::put('/update/profile' , [ManagerDashboardController::class , 'departmentManagerUpdateProfile'])->name('update_profile');



    //Specialties
    Route::get('/view/specialties', [ManagerSpecialtyController::class, 'viewSpecialties'])->name('view_specialties');
    Route::get('/details/specialty/{id}' ,[ManagerSpecialtyController::class , 'detailsSpecialty'])->name('details_specialty');


    //Employees
    Route::get('/view/employees', [ManagerEmployeeController::class, 'viewEmployees'])->name('view_employees');


    //Doctors
    Route::get('/view/doctors', [ManagerDoctorController::class, 'viewDoctors'])->name('view_doctors');
    Route::get('/view/doctors-schedules', [ManagerDoctorController::class, 'viewDoctorsSchedules'])->name('view_doctors_schedules');


    //Patients
    Route::get('/add/patient', [ManagerPatientController::class, 'addPatient'])->name('add_patient');
    Route::get('/view/patients', [ManagerPatientController::class, 'viewPatients'])->name('view_patients');


    //Appointments
    Route::get('/add/appointment', [ManagerAppointmentController::class, 'addAppointment'])->name('add_appointment');
    Route::get('/view/appointments', [ManagerAppointmentController::class, 'viewAppointments'])->name('view_appointments');


    //Prescriptions
    Route::get('/view/prescriptions', [ManagerPrescriptionController::class, 'viewPrescriptions'])->name('view_prescriptions');


    //Patients Insurances
    Route::get('/view/patients-insurances', [ManagerPatientInsuranceController::class, 'viewPatientsInsurances'])->name('view_patients_insurances');




});





//Doctor
Route::prefix('doctor')->name('doctor_')->middleware(['auth', 'verified', 'role:doctor'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [DoctorDashboardController::class, 'doctorDashboard'])->name('dashboard');
    Route::get('/profile' , [DoctorDashboardController::class , 'doctorProfile'])->name('profile');
    Route::get('/edit/profile' , [DoctorDashboardController::class , 'doctorEditProfile'])->name('edit_profile');
    Route::put('/update/profile' , [DoctorDashboardController::class , 'doctorUpdateProfile'])->name('update_profile');


    //My Schedule
    Route::get('/my-schedule', [DoctorDashboardController::class, 'mySchedule'])->name('mySchedule');


    //Patients
    Route::get('/add/patient', [DoctorPatientController::class, 'addPatient'])->name('add_patient');
    Route::get('/view/patients', [DoctorPatientController::class, 'viewPatients'])->name('view_patients');


    //Prescriptions
    Route::get('/add/prescription', [DoctorPrescriptionController::class, 'addPrescription'])->name('add_prescription');
    Route::get('/view/prescriptions', [DoctorPrescriptionController::class, 'viewPrescriptions'])->name('view_prescriptions');




});





//Employees
/** Accountants **/
Route::prefix('employee/accountant')->name('accountant_')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [AccountantDashboardController::class, 'accountantDashboard'])->name('dashboard');
    Route::get('/profile' , [AccountantDashboardController::class , 'accountantProfile'])->name('profile');
    Route::get('/edit/profile' , [AccountantDashboardController::class , 'accountantEditProfile'])->name('edit_profile');
    Route::put('/update/profile' , [AccountantDashboardController::class , 'accountantUpdateProfile'])->name('update_profile');


    //Employees
    Route::get('/view/employees', [AccountantDashboardController::class, 'viewEmployees'])->name('view_employees');


    //Insurances
    Route::get('/view/insurances-providers', [AccountantDashboardController::class, 'viewInsurancesProviders'])->name('view_insurances_providers');
    Route::get('/view/patients-insurances' , [AccountantDashboardController::class , 'viewPatientsInsurances'])->name('view_patients_insurances');


    //Invoices
    Route::get('/view/patients-invoices', [AccountantDashboardController::class, 'viewPatientsInvoices'])->name('view_patients_invoices');
    Route::get('/view/patients-invoices/payments' , [AccountantDashboardController::class , 'viewPatientsInvoicesPayments'])->name('view_patients_invoices_payments');



});



/** Nurses **/
Route::prefix('employee/nurse')->name('nurse_')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [NurseDashboardController::class, 'nurseDashboard'])->name('nurse_dashboard');
    Route::get('/profile' , [NurseDashboardController::class , 'nurseProfile'])->name('nurse_profile');
    Route::get('/edit/profile' , [NurseDashboardController::class , 'nurseEditProfile'])->name('nurse_edit_profile');
    Route::put('/update/profile' , [NurseDashboardController::class , 'nurseUpdateProfile'])->name('nurse_update_profile');




});



/** Receptionists **/
Route::prefix('employee/receptionist')->name('receptionist_')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [ReceptionistDashboardController::class, 'receptionistDashboard'])->name('receptionist_dashboard');
    Route::get('/profile' , [ReceptionistDashboardController::class , 'receptionistProfile'])->name('receptionist_profile');
    Route::get('/edit/profile' , [ReceptionistDashboardController::class , 'receptionistEditProfile'])->name('receptionist_edit_profile');
    Route::put('/update/profile' , [ReceptionistDashboardController::class , 'receptionistUpdateProfile'])->name('receptionist_update_profile');




});



/** Pharmacists **/
Route::prefix('employee/pharmacist')->name('pharmacist_')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [pharmacistDashboardController::class, 'storeSupervisorDashboard'])->name('store_supervisor_dashboard');
    Route::get('/profile' , [pharmacistDashboardController::class , 'storeSupervisorProfile'])->name('store_supervisor_profile');
    Route::get('/edit/profile' , [pharmacistDashboardController::class , 'storeSupervisorEditProfile'])->name('store_supervisor_edit_profile');
    Route::put('/update/profile' , [pharmacistDashboardController::class , 'storeSupervisorUpdateProfile'])->name('store_supervisor_update_profile');


});



/** StoreSupervisors **/
Route::prefix('employee/store-supervisor')->name('store-supervisor_')->middleware(['auth', 'verified', 'role:employee'])->group(function () {

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
    Route::get('/notifications/description/request/read/{id}', [StoreSupervisorNotificationController::class, 'markRequestAsRead'])
    ->name('notifications_description_request_read');      // إشعار طلب جديد



});




/** Patient **/
Route::prefix('patient')->name('patient_')->middleware(['auth', 'verified', 'role:patient'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [PatientDashboardController::class, 'patientDashboard'])->name('patient_dashboard');
    Route::get('/profile' , [PatientDashboardController::class , 'patientProfile'])->name('patient_profile');
    Route::get('/edit/profile' , [PatientDashboardController::class , 'patientEditProfile'])->name('patient_edit_profile');
    Route::put('/update/profile' , [PatientDashboardController::class , 'patientUpdateProfile'])->name('patient_update_profile');




});
