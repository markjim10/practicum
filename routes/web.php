<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// GUEST CONTROLLER
// Route::get('/', 'GuestController@index');
// Route::get('/about', 'GuestController@about');
// Route::get('/chatbot', 'GuestController@chatbot');
// Route::get('/contact', 'GuestController@contact');
// Route::get('/programs', 'GuestController@programs');
// Route::get('/schedule', 'GuestController@schedule');
// Route::get('/register-applicant', 'GuestController@register');
// Route::post('/register-applicant', 'GuestController@store');

Route::get('get_city/{id}', 'GuestController@get_city');
Route::get('email_validation/{email}', 'GuestController@email_validation');
Route::get('phone_validation/{phone}', 'GuestController@phone_validation');
Route::get('/get_application/{id}', 'GuestController@get_application');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admins', 'AdminController@index');
Route::get('/adminsfeedback', 'AdminController@feedbacks');
Route::get('/remove_feedback/{id}', 'AdminController@remove_feedback');

// ADMIN EXAMS CONTROLLER
Route::get('/preview/{id}', 'ExamAdminController@preview');
Route::get('/admins/examination', 'ExamAdminController@create');
Route::post('/store_exam_date', 'ExamAdminController@store_exam_date');
Route::get('/remove_exam_date/{data}', 'ExamAdminController@remove_exam_date');
Route::get('/remove_exam/{id}', 'ExamAdminController@remove_exam');
Route::post('/create_subject', 'ExamAdminController@create_subject');
Route::get('/subject_show/{id}', 'ExamAdminController@subject_show');
Route::get('/update_subject/{data}', 'ExamAdminController@update_subject');
Route::get('/subject_remove/{id}', 'ExamAdminController@subject_remove');

// CREATE EXAM
Route::post('/create_exam', 'ExamAdminController@create_exam');

// ADMIN APPLICANTS CONTROLLER
Route::get('/admins/applicants', 'AdminController@applicants');
Route::get('/admins/applicants/edit/{id}', 'AdminController@applicants_edit');
Route::get('/applicants/{status}/{id}', 'AdminController@applicants_status');

// APPLICANTS CONTROLLER
Route::get('/applicants', 'ApplicantController@index');
Route::get('/applicants/profile', 'ApplicantController@profile');
Route::get('/applicants/exam_results', 'ApplicantController@exam_results');
Route::get('/applicants/send_feedback', 'ApplicantController@send_feedback');
Route::post('/select_date', 'ApplicantController@select_date');
Route::get('/exam_live', 'ApplicantController@exam_live');
Route::get('/isDatePassed', 'ApplicantController@isDatePassed');
Route::post('/exam_submit', 'ApplicantController@exam_submit');
Route::get('/update_temp_answer/{data}', 'ApplicantController@update_temp_answer');

Route::post('/send-feedback', 'ApplicantController@store_feedback');

// SYSADMIN CONTROLLER
Route::get('/sysadmins', 'SysAdminController@index');
Route::get('/view_users', 'SysAdminController@view_users');
Route::get('/view_database', 'SysAdminController@view_database');
Route::get('/view_trails', 'SysAdminController@view_trails');
Route::get('/edit_user/{id}', 'SysAdminController@edit_user');
Route::post('/registerUser', 'SysAdminController@registerUser');
Route::post('/update_user', 'SysAdminController@update_user');
Route::get('/remove_user/{id}', 'SysAdminController@remove_user');


// GENERATE DATA
Route::get('/generate', 'GenerateController@index');
Route::post('/generate', 'GenerateController@generate_applicants');
Route::get('/approve', 'GenerateController@approve');
Route::get('/createSubject', 'GenerateController@createSubject');


// CHAT BOT CONTROLLER
Route::get('/admins/chatbots/chatbot_home', 'ChatBotController@index');
Route::get('/chatbot/{message}', 'ChatBotController@message');
Route::get('/admins/chatbots/chatbot_response/{id}', 'ChatBotController@create');
Route::post('/create_word', 'ChatBotController@create_word');
Route::post('/remove_word', 'ChatBotController@remove_word');
Route::post('/create_response', 'ChatBotController@create_response');
Route::post('/update_response', 'ChatBotController@update_response');
Route::post('/remove_response', 'ChatBotController@remove_response');

// EXCEL

Route::get('exportUsers', 'ExportExcelController@exportUsers');
Route::get('exportApplicants', 'ExportExcelController@exportApplicants');
Route::get('exportAppResults', 'ExportExcelController@exportAppResults');

Route::post('import_users', 'ImportExcelController@import_applicants');
Route::post('import_applicants', 'ImportExcelController@import_applicants');
Route::post('import_results', 'ImportExcelController@import_results');

// REPORTS
Route::get('programs_report', 'ReportsController@programs_report');
Route::get('reports_exams', 'ReportsController@reports_exams');
Route::get('reports_passers', 'ReportsController@reports_passers');
Route::get('reports_school_passing', 'ReportsController@reports_school_passing');

Route::get('editProfile/{id}', 'UserController@editProfile');
Route::post('updateProfile', 'UserController@updateProfile');
Route::post('changePassword', 'UserController@changePassword');

// Dashboard
Route::get('getPreferredPrograms', 'DashboardController@getPreferredPrograms');
Route::get('getApplicantsPassingRate', 'DashboardController@getApplicantsPassingRate');
Route::get('getExamDates', 'DashboardController@getExamDates');

// Home

Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/chatbot', 'HomeController@chatbot');
Route::get('/contact', 'HomeController@contact');
Route::get('/programs', 'HomeController@programs');
Route::get('/schedule', 'HomeController@schedule');

// Register
Route::get('/register_applicant', 'RegisterController@register');
Route::post('/register_applicant', 'RegisterController@store');
Route::get('get_city/{id}', 'RegisterController@get_city');
Route::get('email_validation/{email}', 'RegisterController@email_validation');
Route::get('phone_validation/{phone}', 'RegisterController@phone_validation');
Route::get('/get_application/{id}', 'RegisterController@get_application');

// APPLICANTS CONTROLLER
Route::get('selectApplicantsByStatus/{status}', 'AdminController@selectApplicantsByStatus');
