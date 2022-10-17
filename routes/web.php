<?php

use GuzzleHttp\Middleware;
use App\Models\StudentYear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentgroupController;
use App\Http\Controllers\Backend\Setup\StudentshiftController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});
Route::get('admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');
// Route::group(["Middleware" => "auth"],function(){
    Route::middleware('auth')->group(function () {

// User list & add user
Route::prefix('users')->group(function () {

    Route::get('view', [UserController::class, 'UserView'])->name('users.view');
    Route::get('add', [UserController::class, 'UserAdd'])->name('users.add');
    Route::post('store', [UserController::class, 'UserStore'])->name('users.store');
    Route::get('edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
    Route::post('update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');
    Route::get('delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
});
// user profile and password
Route::prefix('profile')->group(function () {

    Route::get('view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    Route::get('edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
});
// Setup
Route::prefix('setups')->group(function () {
    // student class 
    Route::get('student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
    Route::get('student/class/add', [StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');
    Route::post('student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');
    Route::get('student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');
    // student year
    Route::get('student/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');
    Route::get('student/year/add', [StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');
    Route::post('student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
    Route::post('student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');
    // student group
    Route::get('student/group/view', [StudentgroupController::class, 'ViewGroup'])->name('student.group.view');
    Route::get('student/group/add', [StudentgroupController::class, 'StudentGroupAdd'])->name('student.group.add');
    Route::post('student/group/store', [StudentgroupController::class, 'StudentGroupStore'])->name('store.student.group');
    Route::get('student/group/edit/{id}', [StudentgroupController::class, 'StudentGroupEdit'])->name('student.group.edit');
    Route::post('student/group/update/{id}', [StudentgroupController::class, 'StudentGroupUpdate'])->name('update.student.group');
    Route::get('student/group/delete/{id}', [StudentgroupController::class, 'StudentGroupDelete'])->name('student.group.delete');
    // student shift
    Route::get('student/shift/view', [StudentshiftController::class, 'ViewShift'])->name('student.shift.view');
    Route::get('student/shift/add', [StudentshiftController::class, 'StudentShiftAdd'])->name('student.shift.add');
    Route::post('student/shift/store', [StudentshiftController::class, 'StudentShiftStore'])->name('store.student.shift');
    Route::get('student/shift/edit/{id}', [StudentshiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');
    Route::post('student/shift/update/{id}', [StudentshiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');
    Route::get('student/shift/delete/{id}', [StudentshiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');
    // student fee
    Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCat'])->name('fee.category.view');
    Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCatAdd'])->name('fee.category.add');
    Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCatStore'])->name('store.fee.category');
    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit'])->name('fee.category.edit');
    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCatUpdate'])->name('update.fee.category');
    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCatDelete'])->name('fee.category.delete');
    // fee category amount
    Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');
    Route::get('fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('fee.amount.add');
    Route::post('fee/amount/store', [FeeAmountController::class, 'StoreFeeAmount'])->name('store.fee.amount');
    Route::get('fee/amount/edit/{id}', [FeeAmountController::class, 'EditFeeAmount'])->name('fee.amount.edit');
    Route::post('fee/amount/update/{id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');
    Route::get('fee/amount/details/{id}', [FeeAmountController::class, 'DetailsFeeAmount'])->name('fee.amount.details');
    // Exam type
    Route::get('exam/type/view', [ExamTypeController::class, 'ViewExamType'])->name('exam.type.view');
    Route::get('exam/type/add', [ExamTypeController::class, 'ExamTypeAdd'])->name('exam.type.add');
    Route::post('exam/type/store', [ExamTypeController::class, 'ExamTypeStore'])->name('store.exam.type');
    Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');
    Route::post('exam/type/update/{id}', [ExamTypeController::class, 'ExamTypeUpdate'])->name('update.exam.type');
    Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');
    // School subject
    Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');
    Route::get('school/subject/add', [SchoolSubjectController::class, 'SchoolSubjectAdd'])->name('school.subject.add');
    Route::post('school/subject/store', [SchoolSubjectController::class, 'SchoolSubjectStore'])->name('store.school.subject');
    Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'SchoolSubjectEdit'])->name('school.subject.edit');
    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'SchoolSubjectUpdate'])->name('update.school.subject');
    Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'SchoolSubjectDelete'])->name('school.subject.delete');
    // Assign subject
    Route::get('assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');
    Route::get('assign/subject/add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');
    Route::post('assign/subject/store', [AssignSubjectController::class, 'StoreAssignSubject'])->name('store.assign.subject');
    Route::get('assign/subject/edit/{id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');
    Route::post('assign/subject/update/{id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('update.assign.subject');
    Route::get('assign/subject/details/{id}', [AssignSubjectController::class, 'DetailsAssignSubject'])->name('assign.subject.details');
    // Designation
    Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');
    Route::get('designation/add', [DesignationController::class, 'DesignationAdd'])->name('designation.add');
    Route::post('designation/store', [DesignationController::class, 'DesignationStore'])->name('store.designation');
    Route::get('designation/edit/{id}', [DesignationController::class, 'DesignationEdit'])->name('designation.edit');
    Route::post('designation/update/{id}', [DesignationController::class, 'DesignationUpdate'])->name('update.designation');
    Route::get('designation/delete/{id}', [DesignationController::class, 'DesignationDelete'])->name('designation.delete');
});
// user profile and password
Route::prefix('students')->group(function () {
// Student Registration
    Route::get('reg/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');
    Route::get('registration/add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');
    Route::post('reg/store', [StudentRegController::class, 'StudentRegStore'])->name('store.student.registration');
    Route::get('year/class/wise', [StudentRegController::class, 'StudentClassYearWise'])->name('student.year.class.wise');
    Route::get('reg/edit/{id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');
    Route::post('reg/update/{id}', [StudentRegController::class, 'StudentRegUpdate'])->name('update.student.registration');
    Route::get('reg/promotion/{id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');
    Route::post('reg/update/promotion/{id}', [StudentRegController::class, 'StudentUpdatePromotion'])->name('promotion.student.registration');
    Route::get('reg/details/{id}', [StudentRegController::class, 'StudentRegDetails'])->name('student.registration.details');
    // student roll generate
    Route::get('roll/generate/view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');
    Route::get('reg/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');
    Route::post('roll/generate/store', [StudentRollController::class, 'StudentRollStore'])->name('roll.generate.store');
    // Registration Fee Routes 
    Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');
    Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');
    Route::get('/reg/fee/payslip/{id}', [RegistrationFeeController::class, 'RegFeePayslip'])->name('student.registration.fee.payslip');
    // Monthly Fee Routes 
    Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');
    Route::get('/monthly/fee/classwisedata', [MonthlyFeeController::class, 'MonthlyFeeClassData'])->name('student.monthly.fee.classwise.get');
    Route::get('/monthly/fee/payslip/{id}/{month}', [MonthlyFeeController::class, 'MonthlyFeePayslip'])->name('student.monthly.fee.payslip');
    // Exam Fee Routes 
    Route::get('/exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');
    Route::get('/exam/fee/classwisedata', [ExamFeeController::class, 'ExamFeeClassData'])->name('student.exam.fee.classwise.get');
    Route::get('/exam/fee/payslip/{id}/{exam_type}', [ExamFeeController::class, 'ExamFeePayslip'])->name('student.exam.fee.payslip');
});
// employee registration
Route::prefix('employees')->group(function () {

    Route::get('reg/employee/view', [EmployeeRegController::class, 'EmployeeView'])->name('employee.registration.view');
    Route::get('reg/employee/add', [EmployeeRegController::class, 'EmployeeAdd'])->name('employee.registration.add');
    Route::post('reg/employee/store', [EmployeeRegController::class, 'EmployeeStore'])->name('store.employee.registration');
    Route::get('reg/employee/edit/{id}', [EmployeeRegController::class, 'EmployeeEdit'])->name('employee.registration.edit');
    Route::post('reg/employee/update/{id}', [EmployeeRegController::class, 'EmployeeUpdate'])->name('update.employee.registration');
    Route::get('reg/employee/details/{id}', [EmployeeRegController::class, 'EmployeeDetails'])->name('employee.registration.details');
// Employee Salary
    Route::get('salary/employee/view', [EmployeeSalaryController::class, 'SalaryView'])->name('employee.salary.view');
    Route::get('salary/employee/increment/{id}', [EmployeeSalaryController::class, 'SalaryIncrement'])->name('employee.salary.increment');
    Route::post('salary/employee/store/{id}', [EmployeeSalaryController::class, 'SalaryStore'])->name('update.increment.store');
    Route::get('salary/employee/details/{id}', [EmployeeSalaryController::class, 'SalaryDetails'])->name('employee.salary.details');
// Employee Leave
Route::get('leave/employee/view', [EmployeeLeaveController::class, 'LeaveView'])->name('employee.leave.view');
Route::get('leave/employee/add', [EmployeeLeaveController::class, 'LeaveAdd'])->name('employee.leave.add');
Route::post('leave/employee/store', [EmployeeLeaveController::class, 'LeaveStore'])->name('store.employee.leave');
Route::get('leave/employee/edit/{id}', [EmployeeLeaveController::class, 'LeaveEdit'])->name('employee.leave.edit');
Route::post('leave/employee/update/{id}', [EmployeeLeaveController::class, 'LeaveUpdate'])->name('update.employee.leave');
Route::get('leave/employee/delete/{id}', [EmployeeLeaveController::class, 'LeaveDelete'])->name('employee.leave.delete');
// Employee Attendence
Route::get('attendance/employee/view', [EmployeeAttendanceController::class, 'AttendanceView'])->name('employee.attendance.view');
Route::get('attendance/employee/add', [EmployeeAttendanceController::class, 'AttendanceAdd'])->name('employee.attendance.add');
Route::post('attendance/employee/store', [EmployeeAttendanceController::class, 'AttendanceStore'])->name('store.employee.attendance');
Route::get('attendance/employee/edit/{id}', [EmployeeAttendanceController::class, 'AttendanceEdit'])->name('employee.attendance.edit');
Route::get('attendance/employee/details/{id}', [EmployeeAttendanceController::class, 'AttendanceDetails'])->name('employee.attendance.details');
// Employee Monthly Salary
Route::get('monthly/salary/view', [MonthlySalaryController::class, 'MonthlySalaryView'])->name('employee.monthly.salary');
Route::get('monthly/salary/get', [MonthlySalaryController::class, 'MonthlySalaryGet'])->name('employee.monthly.salary.get');
Route::get('monthly/salary/payslip/{id}/{d}/{absent}/{salaryofThisMonth}', [MonthlySalaryController::class, 'MonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');
});
/// Student Marks Management   
Route::prefix('marks')->group(function(){

    Route::get('marks/entry/add', [MarksController::class, 'MarksAdd'])->name('marks.entry.add');
    
    Route::post('marks/entry/store', [MarksController::class, 'MarksStore'])->name('marks.entry.store'); 
    
    Route::get('marks/entry/edit', [MarksController::class, 'MarksEdit'])->name('marks.entry.edit'); 
    
    Route::get('marks/getstudents/edit', [MarksController::class, 'MarksEditGetStudents'])->name('student.edit.getstudents');
    
    Route::post('marks/entry/update', [MarksController::class, 'MarksUpdate'])->name('marks.entry.update');  
// Marks Entry Grade 

Route::get('marks/grade/view', [GradeController::class, 'MarksGradeView'])->name('marks.entry.grade');

Route::get('marks/grade/add', [GradeController::class, 'MarksGradeAdd'])->name('marks.grade.add');

Route::post('marks/grade/store', [GradeController::class, 'MarksGradeStore'])->name('store.marks.grade');

Route::get('marks/grade/edit/{id}', [GradeController::class, 'MarksGradeEdit'])->name('marks.grade.edit');

Route::post('marks/grade/update/{id}', [GradeController::class, 'MarksGradeUpdate'])->name('update.marks.grade');
}); 
 
Route::get('marks/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');

Route::get('student/marks/getstudents', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');

/// Account Management Routes  
Route::prefix('accounts')->group(function(){

    Route::get('student/fee/view', [StudentFeeController::class, 'StudentFeeView'])->name('student.fee.view');
    
    Route::get('student/fee/add', [StudentFeeController::class, 'StudentFeeAdd'])->name('student.fee.add');
    
    Route::get('student/fee/getstudent', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('account.fee.getstudent'); 
    
    Route::post('student/fee/store', [StudentFeeController::class, 'StudentFeeStore'])->name('account.fee.store'); 
    
    // Employee Salary Routes
    Route::get('account/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.salary.view');
    
    Route::get('account/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');
    
    Route::get('account/salary/getemployee', [AccountSalaryController::class, 'AccountSalaryGetEmployee'])->name('account.salary.getemployee');
    
    Route::post('account/salary/store', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');
    
    // Other Cost Rotues 
    
    Route::get('other/cost/view', [OtherCostController::class, 'OtherCostView'])->name('other.cost.view');
    
    Route::get('other/cost/add', [OtherCostController::class, 'OtherCostAdd'])->name('other.cost.add');
    
    Route::post('other/cost/store', [OtherCostController::class, 'OtherCostStore'])->name('store.other.cost');
    
    Route::get('other/cost/edit/{id}', [OtherCostController::class, 'OtherCostEdit'])->name('edit.other.cost');
    
    Route::post('other/cost/update/{id}', [OtherCostController::class, 'OtherCostUpdate'])->name('update.other.cost');
    
    }); 
}); /*End middleware*/
