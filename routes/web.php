<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentgroupController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use App\Models\StudentYear;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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


Route::get('admin/logout',[AdminController::class, 'Logout'])->name('admin.logout');
// User list & add user
Route::prefix('users')->group(function(){

    Route::get('view',[UserController::class, 'UserView'])->name('users.view');
    Route::get('add',[UserController::class, 'UserAdd'])->name('users.add');
    Route::post('store',[UserController::class, 'UserStore'])->name('users.store');
    Route::get('edit/{id}',[UserController::class, 'UserEdit'])->name('users.edit');
    Route::post('update/{id}',[UserController::class, 'UserUpdate'])->name('users.update');
    Route::get('delete/{id}',[UserController::class, 'UserDelete'])->name('users.delete');
});
// user profile and password
Route::prefix('profile')->group(function(){

    Route::get('view',[ProfileController::class, 'ProfileView'])->name('profile.view');
    Route::get('edit',[ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('store',[ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('password/view',[ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('password/update',[ProfileController::class, 'PasswordUpdate'])->name('password.update');
});
// Setup
Route::prefix('setups')->group(function(){
// student class 
    Route::get('student/class/view',[StudentClassController::class, 'ViewStudent'])->name('student.class.view');
    Route::get('student/class/add',[StudentClassController::class, 'StudentClassAdd'])->name('student.class.add');
    Route::post('student/class/store',[StudentClassController::class, 'StudentClassStore'])->name('store.student.class');
    Route::get('student/class/edit/{id}',[StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}',[StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');
    Route::get('student/class/delete/{id}',[StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');
    // student year
    Route::get('student/year/view',[StudentYearController::class, 'ViewYear'])->name('student.year.view');
    Route::get('student/year/add',[StudentYearController::class, 'StudentYearAdd'])->name('student.year.add');
    Route::post('student/year/store',[StudentYearController::class, 'StudentYearStore'])->name('store.student.year');
    Route::get('student/year/edit/{id}',[StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
    Route::post('student/year/update/{id}',[StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');
    Route::get('student/year/delete/{id}',[StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');
    // student group
    Route::get('student/group/view',[StudentgroupController::class, 'ViewGroup'])->name('student.group.view');
    Route::get('student/group/add',[StudentgroupController::class, 'StudentGroupAdd'])->name('student.group.add');
    Route::post('student/group/store',[StudentgroupController::class, 'StudentGroupStore'])->name('store.student.group');
    Route::get('student/group/edit/{id}',[StudentgroupController::class, 'StudentGroupEdit'])->name('student.group.edit');
    Route::post('student/group/update/{id}',[StudentgroupController::class, 'StudentGroupUpdate'])->name('update.student.group');
    Route::get('student/group/delete/{id}',[StudentgroupController::class, 'StudentGroupDelete'])->name('student.group.delete');
});