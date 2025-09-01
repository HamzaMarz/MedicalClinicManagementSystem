<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;   // ✅ مهم جداً

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void{
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $currentUser = null;

            $admin = null;
            $departmentManager = null;
            $doctor = null;

            $storeSupervisor = null;
            $accountant = null;
            $nurse = null;
            $receptionist = null;

            $employee = null;
            $employeeJobTitle = null;

            $patient = null;

            if (Auth::check()) {
                $user = Auth::user();
                $currentUser = $user;

                if ($user->hasRole('admin')) {
                    $admin = $user;

                } elseif ($user->hasRole('department_manager')) {
                    $departmentManager = $user;

                } elseif ($user->hasRole('doctor')) {
                    $doctor = $user;

                } elseif ($user->hasRole('employee')) {
                    $employee = $user;
                    $jobTitle = $user->employee?->jobTitles()->first();
                    $employeeJobTitle = $jobTitle ? $jobTitle->name : 'general';

                    // التفرع حسب اسم الوظيفة
                    if ($employeeJobTitle === 'store_supervisor') {
                        $storeSupervisor = $user;
                    } elseif ($employeeJobTitle === 'accountant') {
                        $accountant = $user;
                    } elseif ($employeeJobTitle === 'nurse') {
                        $nurse = $user;
                    } elseif ($employeeJobTitle === 'receptionist') {
                        $receptionist = $user;
                    }
                } elseif ($user->hasRole('patient')) {
                    $patient = $user;
                }
            }

            $view->with(compact(
                'currentUser',
                'admin',
                'departmentManager',
                'doctor',
                'storeSupervisor',
                'accountant',
                'nurse',
                'receptionist',
                'employee',
                'employeeJobTitle',
                'patient'
            ));
        });

    }
}
