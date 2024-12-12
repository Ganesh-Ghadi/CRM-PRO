<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LeadsController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\ContactsController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\Api\SuppliersController;
use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Api\TaskSubmissionsController;
use App\Http\Controllers\Api\RolesPermissionsController;
use App\Http\Controllers\Api\ProductCategoriesController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum', 'permission']], function(){
   Route::get('/permissions', [RolesPermissionsController::class, 'index'])->name('permissions.index');

   //crm->start
   Route::resource('clients', ClientsController::class); 
   Route::resource('contacts', ContactsController::class);
   Route::resource('suppliers', SuppliersController::class); 
   //crm->end
   
   Route::resource('projects', ProjectsController::class); 
   Route::resource('departments', DepartmentController::class);  
   Route::resource('employees', EmployeesController::class);  
   Route::resource('products', ProductsController::class);  
   Route::resource('companies', CompaniesController::class);  
   Route::resource('contacts', ContactsController::class);  
   Route::resource('product_categories', ProductCategoriesController::class);  
   Route::resource('roles', RolesController::class);
   Route::resource('permissions', PermissionsController::class);    

   Route::delete('/users/{id}', [UserController::class, 'destroy'])->name("users.destroy");

   Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});