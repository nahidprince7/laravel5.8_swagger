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

//Route::get('/', function () {
//    return view('welcome');
//});


/*users*/
$users = 'users/';

Route::get($users, 'UserController@index')->name('user-list')
    ->middleware(['auth']);


/*Route::group(['middleware' => 'CheckRole:admin'], function () {
    Route::get('users/', 'UserController@index')->name('user-list');
});*/

Route::get($users . 'detail/{id}', 'UserController@userDetail')->name('user-detail')->middleware(['auth']);
Route::get($users . 'demo', 'UserController@demoUserDetail')->middleware(['auth']);

Route::get($users . 'create', 'UserController@create')->name('create-user')->middleware(['auth', "checkRole:" . ADMIN]);
Route::post($users . 'add', 'UserController@store')->middleware(['auth', 'checkRole:' . ADMIN]);
Route::get($users . 'edit/{id}', 'UserController@edit')->name('edit-user')->middleware(['auth']);
Route::post($users . 'update/{id}', 'UserController@update')->middleware(['auth', "checkRole:" . ADMIN . ':' . ROLE_EMPLOYEE . ':' . ROLE_HOD . ':' . SYSTEM_ADMIN]);

//Route::get($users . 'delete/{id}', 'UserController@destroy')->middleware('auth');
Route::post($users . 'trash', 'UserController@moveToTrash')->name('trash-user')->middleware(['auth', "checkRole:" . ADMIN]);


//Reseller Role
Route::get('/user/assignRole/{user_id}', 'UserRoleController@assignRolesToUser')->name('assign-userRole')->middleware(['auth', "checkRole:" . ADMIN]);
Route::post('/user/udpateUserRole/{user_id}', 'UserRoleController@updateUserRoles')->name('update-userRoles')->middleware(['auth', "checkRole:" . ADMIN]);;


$dashboard = 'dashboard/';
//Route::get('/', 'UserController@index')->middleware('auth')->middleware(['auth', "checkRole:" . ADMIN . ':' . TEAM_LEAD . ':' . TECHNICIAN . ':' . SYSTEM_ADMIN]);
Route::middleware(['auth'])->group(function () {

    //designation
    Route::get('/designation', 'DesignationController@index');
    Route::post('/designation', 'DesignationController@designationSave')->name('designation-save');
    Route::post('/designation/update/{id}', 'DesignationController@designationUpdate');
    Route::get('/designation-sorting', 'DesignationController@sort')->name('designation-sorting');
    Route::post('/updateHierarchy', 'DesignationController@updateHierarchy');
    Route::post('/designation/trash', 'DesignationController@moveToTrash')->name('designation-trash');
    //division
    Route::get('/division', 'DivisionController@index');
    Route::post('/division', 'DivisionController@divisionSave')->name('division-save');
    Route::post('/division/update/{id}', 'DivisionController@divisionUpdate');
    Route::post('/division/trash', 'DivisionController@divisionMoveToTrash')->name('division-trash');

    //department
    Route::get('/department', 'DepartmentController@index');
    Route::post('/department', 'DepartmentController@departmentSave')->name('department-save');
    Route::post('/department/update/{id}', 'DepartmentController@departmentUpdate');
    Route::post('/department/trash', 'DepartmentController@departmentMoveToTrash')->name('department-trash')->middleware(['auth', 'checkRole:' . ADMIN]);

    //dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



});

Route::get('/', function () {
    if (Auth::id()) {
        return redirect(route('dashboard'));
//        return redirect(route('user-detail', Auth::id()));
    } else {
        return redirect(route('login'));
    }

});

Auth::routes();
