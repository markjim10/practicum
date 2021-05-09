<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/admins', 'AdminController@index');

// APPLICANTS CONTROLLER
Route::get('/applicants', 'ApplicantController@index')->name('applicants');
Route::get('/applicants/profile', 'ApplicantController@profile');
Route::get('/applicants/exam_results', 'ApplicantController@exam_results');
Route::get('/applicants/send_feedback', 'ApplicantController@send_feedback');

// GENERATE DATA
Route::get('/generate', 'GenerateController@index');
Route::post('/generate', 'GenerateController@generate_applicants');
Route::get('/approve', 'GenerateController@approve');
Route::get('/generateSubject', 'GenerateController@createSubject');

// EXCEL
Route::get('exportUsers', 'ExportExcelController@exportUsers');
Route::get('exportApplicants', 'ExportExcelController@exportApplicants');
Route::get('exportAppResults', 'ExportExcelController@exportAppResults');

// REPORTS
Route::get('reports_programs', 'ReportsController@reports_programs');
Route::get('reports_exams', 'ReportsController@reports_exams');
Route::get('reports_passers', 'ReportsController@reports_passers');
Route::get('reports_school_passing', 'ReportsController@reports_school_passing');

// UserController
Route::get('editProfile/{id}', 'UserController@editProfile');
Route::post('updateProfile', 'UserController@updateProfile');
Route::post('changePassword', 'UserController@changePassword');

// DashboardController
Route::get('getPreferredPrograms', 'DashboardController@getPreferredPrograms');
Route::get('getApplicantsPassingRate', 'DashboardController@getApplicantsPassingRate');
Route::get('getExamDates', 'DashboardController@getExamDates');
Route::get('getListPassers', 'DashboardController@getListPassers');

// HomeController
Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/chatbot', 'HomeController@chatbot');
Route::get('/contact', 'HomeController@contact');
Route::get('/programs', 'HomeController@programs');
Route::get('/schedule', 'HomeController@schedule');
Route::get('/chatbot/{message}', 'ChatBotController@message');

// RegisterController
Route::get('/register_applicant', 'RegisterController@register');
Route::post('/register_applicant', 'RegisterController@store');
Route::get('get_city/{id}', 'RegisterController@get_city');
Route::get('email_validation/{email}', 'RegisterController@email_validation');
Route::get('phone_validation/{phone}', 'RegisterController@phone_validation');
Route::get('/get_application/{id}', 'RegisterController@get_application');

// ADMINS->APPLICANT CONTROLLER
Route::get('selectApplicantsByStatus/{status}', 'AdminController@selectApplicantsByStatus');
Route::get('/admins/applicants/edit/{id}', 'AdminController@applicants_edit');
Route::get('/admins/applicants', 'AdminController@applicants');
Route::get('/applicants/{status}/{id}', 'AdminController@applicants_status');

// SubjectController
Route::resource('subjects', 'SubjectController');
Route::get('/subjects/remove/{id}', 'SubjectController@remove');

// ExamController
Route::resource('exams', 'ExamController');

// ResponseController
Route::resource('responses', 'ResponseController');
Route::get('responses/remove/{id}', 'ResponseController@remove');
Route::post('responses/addWord', 'ResponseController@addWord');
Route::get('responses/removeWord/{id}', 'ResponseController@removeWord');

// SYSADMIN CONTROLLER
Route::get('/sysadmins', 'SysAdminController@index');
Route::post('/sysadmins/register_user', 'SysAdminController@register_user');
Route::get('/sysadmins/edit/{id}', 'SysAdminController@edit');
Route::post('/sysadmins/update', 'SysAdminController@update');
Route::post('/sysadmins/delete', 'SysAdminController@delete');
Route::get('/sysadmins/trails', 'SysAdminController@trails');
Route::get('/sysadmins/database', 'SysAdminController@database');

// APPLICANT->EXAM CONTROLLER
Route::post('/applicants/select_date', 'ApplicantController@select_date');
Route::get('/applicants/exam_live', 'ApplicantController@exam_live');
Route::post('/applicants/exam_submit', 'ApplicantController@exam_submit');
Route::post('/applicants/update_temp_answer', 'ApplicantController@update_temp_answer');
Route::get('/isDatePassed', 'ApplicantController@isDatePassed');
