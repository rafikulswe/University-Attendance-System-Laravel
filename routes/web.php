<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Profile
Route::get('/profile', 'ProfileController@index')->name('profile');

//Semister
Route::get('/supervisorSemister', 'SupervisorSemisterController@index')->name('supervisorSemister');
Route::get('/createSupervisorSemister', 'SupervisorSemisterController@create')->name('createSupervisorSemister');
Route::post('/saveSupervisorSemister', 'SupervisorSemisterController@store')->name('saveSupervisorSemister');
Route::get('/editSupervisorSemister/{id}', 'SupervisorSemisterController@edit')->name('editSupervisorSemister','id');
Route::post('/updateSupervisorSemister', 'SupervisorSemisterController@update')->name('updateSupervisorSemister');

//Schedule
Route::get('/editSupervisorSchedule/{id}', 'SupervisorSemisterController@editSchedule')->name('editSupervisorSchedule','id');
Route::post('/updateSupervisorSchedule', 'SupervisorSemisterController@updateSchedule')->name('updateSupervisorSchedule');

//Employee Semister Schedule
Route::get('/employeeSemister', 'SupervisorSemisterController@employeeSemister')->name('employeeSemister');
Route::get('/viewEmployeeSchedule/{id}', 'SupervisorSemisterController@viewEmployeeSchedule')->name('viewEmployeeSchedule','id');
Route::post('/approveEmployeeSchedule', 'SupervisorSemisterController@approveEmployeeSchedule')->name('approveEmployeeSchedule');
Route::get('/justScheduleView/{id}', 'SupervisorSemisterController@justScheduleView')->name('justScheduleView','id');

//Attendace
Route::get('/attendance', 'AttendanceController@index')->name('attendance');
Route::get('/createAttendance', 'AttendanceController@create')->name('createAttendance');
Route::post('/saveAttendance', 'AttendanceController@store')->name('saveAttendance');
Route::get('/editAttendance/{id}', 'AttendanceController@edit')->name('editAttendance','id');
Route::post('/updateAttendance', 'AttendanceController@update')->name('updateAttendance');

//Supervisor Attendance notifications 
Route::get('/employeeAttendance', 'AttendanceController@employeeAttendance')->name('employeeAttendance');
Route::get('/viewEmpAttendance/{id}', 'AttendanceController@viewEmpAttendance')->name('viewEmpAttendance','id');
Route::post('/approveEmpAttendance', 'AttendanceController@approveEmpAttendance')->name('approveEmpAttendance');

//Own Attendace Report Search
Route::get('/ownAttendReport', 'AttendanceController@ownReportSearch')->name('ownAttendReport');
Route::post('/ownAttendReportAction', 'AttendanceController@ownReportSearchAction')->name('ownAttendReportAction');

//Attendace Report Search for Supervisor
Route::get('/attendanceReport', 'AttendanceController@reportSearch')->name('attendanceReport');
Route::post('/attendanceReportAction', 'AttendanceController@reportSearchAction')->name('attendanceReportAction');

Route::get('print-report', 'AttendanceController@printReport')->name('printReport');

Route::prefix('admin')->group(function() {
	Route::get('/','softAdmin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/', 'softAdmin\LoginController@login')->name('admin.login.submit');
	Route::get('logout/', 'softAdmin\LoginController@logout')->name('admin.logout');

	Route::get('/home', 'AdminController@index')->name('admin.home');

	//Supervisor
	Route::get('/supervisor', 'softAdmin\SupervisorController@index')->name('admin.supervisor');
	Route::get('/createSupervisor', 'softAdmin\SupervisorController@create')->name('admin.createSupervisor');
	Route::post('/saveSupervisor', 'softAdmin\SupervisorController@store')->name('admin.saveSupervisor');
	Route::get('/editSupervisor/{id}', 'softAdmin\SupervisorController@edit')->name('admin.editSupervisor','id');
	Route::post('/updateSupervisor', 'softAdmin\SupervisorController@update')->name('admin.updateSupervisor');
	
	//Employee
	Route::get('/employee', 'softAdmin\EmployeeController@index')->name('admin.employee');
	Route::get('/createEmployee', 'softAdmin\EmployeeController@create')->name('admin.createEmployee');
	Route::post('/saveEmployee', 'softAdmin\EmployeeController@store')->name('admin.saveEmployee');
	Route::get('/editEmployee/{id}', 'softAdmin\EmployeeController@edit')->name('admin.editEmployee','id');
	Route::post('/updateEmployee', 'softAdmin\EmployeeController@update')->name('admin.updateEmployee');
	
	//Department
	Route::get('/dept', 'softAdmin\EmployeeDepartmentController@index')->name('admin.dept');
	Route::get('/createDept', 'softAdmin\EmployeeDepartmentController@create')->name('admin.createDept');
	Route::post('/saveDept', 'softAdmin\EmployeeDepartmentController@store')->name('admin.saveDept');
	Route::get('/editDept/{id}', 'softAdmin\EmployeeDepartmentController@edit')->name('admin.editDept','id');
	Route::post('/updateDept', 'softAdmin\EmployeeDepartmentController@update')->name('admin.updateDept');
	
	//Designation
	Route::get('/designation', 'softAdmin\EmployeeDesignationController@index')->name('admin.designation');
	Route::get('/createDesignation', 'softAdmin\EmployeeDesignationController@create')->name('admin.createDesignation');
	Route::post('/saveDesignation', 'softAdmin\EmployeeDesignationController@store')->name('admin.saveDesignation');
	Route::get('/editDesignation/{id}', 'softAdmin\EmployeeDesignationController@edit')->name('admin.editDesignation','id');
	Route::post('/updateDesignation', 'softAdmin\EmployeeDesignationController@update')->name('admin.updateDesignation');

	//Supervisor Semister Schedule
	Route::get('/supervisorSemister', 'softAdmin\SupervisorScheduleController@supervisorSemister')->name('admin.supervisorSemister');
	Route::get('/viewSupervisorSchedule/{id}', 'softAdmin\SupervisorScheduleController@viewSupervisorSchedule')->name('admin.viewSupervisorSchedule','id');
	Route::post('/approveSupervisorSchedule', 'softAdmin\SupervisorScheduleController@approveSupervisorSchedule')->name('admin.approveSupervisorSchedule');
	Route::get('/justScheduleView/{id}', 'softAdmin\SupervisorScheduleController@justScheduleView')->name('admin.justScheduleView','id');

	//Supervisor Attendance notifications 
	Route::get('/supervisorAttendance', 'softAdmin\SupervisorAttendanceController@index')->name('admin.supervisorAttendance');
	Route::get('/viewSupAttendance/{id}', 'softAdmin\SupervisorAttendanceController@viewSupAttendance')->name('admin.viewSupAttendance','id');
	Route::post('/approveSupAttendance', 'softAdmin\SupervisorAttendanceController@approveSupAttendance')->name('admin.approveSupAttendance');

	//Attendace Report
	Route::get('/attendanceReport', 'softAdmin\SupervisorAttendanceController@reportSearch')->name('admin.attendanceReport');
	Route::post('/attendanceReportAction', 'softAdmin\SupervisorAttendanceController@reportSearchAction')->name('admin.attendanceReportAction');
	Route::get('print-report', 'softAdmin\SupervisorAttendanceController@printReport')->name('admin.printReport');
	Route::get('/password-reset', 'softAdmin\LoginController@logout')->name('admin.password.request');
});
