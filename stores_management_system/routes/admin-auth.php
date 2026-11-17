<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\Auth\ItemController;
use App\Http\Controllers\Admin\Auth\StoreController;
use App\Http\Controllers\Admin\Auth\OrdersController;
use App\Http\Controllers\Admin\Auth\MessageController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\Auth\CategoryController;
use App\Http\Controllers\Admin\Auth\EmployeeController;
use App\Http\Controllers\Admin\Auth\LocationController;
use App\Http\Controllers\Admin\Auth\SupplierController;
use App\Http\Controllers\Admin\Auth\DepartmentController;
use App\Http\Controllers\Admin\Auth\SubCategoryController;
use App\Http\Controllers\Admin\Auth\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\StockTransactionController;
use App\Http\Controllers\Admin\Auth\JobController;
use App\Http\Controllers\Admin\Auth\JobHistoryController;


// Guest Routes (No Auth Required)
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [AdminController::class, 'register']);
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.post');
});

// Authenticated Routes (View Only - All Roles)
Route::prefix('admin')->middleware(['auth:admin', 'view.only'])->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/messages', [MessageController::class, 'showMessages'])->name('messages');

    //Route::get('employee', [EmployeeController::class, 'index'])->name('admin.employee');
    Route::get('category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('sub_category', [SubCategoryController::class, 'index'])->name('admin.subCategory');
    Route::get('item', [ItemController::class, 'index'])->name('admin.item');
    Route::get('location', [LocationController::class, 'index'])->name('admin.location');
    Route::get('supplier', [SupplierController::class, 'index'])->name('admin.supplier');
    Route::get('stores', [StoreController::class, 'index'])->name('admin.stores');
    Route::get('department', [DepartmentController::class, 'index'])->name('admin.department');
    Route::get('orders', [OrdersController::class, 'index'])->name('admin.orders');
    Route::get('stock', [StockTransactionController::class, 'index'])->name('admin.stock.index');
    Route::get('stock/{transaction_reference}/receipt', [StockTransactionController::class, 'receipt'])->name('admin.stock.receipt');
    Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');
    Route::get('admin/jobs/{job}/pdf', [JobController::class, 'generatePdf'])->name('admin.jobs.pdf');

    
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// Stock Keeper Routes (Add, Edit, View)
Route::prefix('admin')->middleware(['auth:admin', 'stockkeeper'])->group(function () {
    //Route::get('employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    //Route::post('employee/create', [EmployeeController::class, 'store'])->name('admin.employee.store');
    //Route::get('employee/{employee_id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
    //Route::put('employee/{employee_id}/edit', [EmployeeController::class, 'update'])->name('admin.employee.update');

    Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category/create', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/{category_id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('category/{category_id}/edit', [CategoryController::class, 'update'])->name('admin.category.update');

    Route::get('sub_category/create', [SubCategoryController::class, 'create'])->name('admin.subCategory.create');
    Route::post('sub_category/create', [SubCategoryController::class, 'store'])->name('admin.subCategory.store');
    Route::get('sub_category/{id}/edit', [SubCategoryController::class, 'edit'])->name('admin.subCategory.edit');
    Route::put('sub_category/{id}/edit', [SubCategoryController::class, 'update'])->name('admin.subCategory.update');

    Route::get('item/create', [ItemController::class, 'create'])->name('admin.item.create');
    Route::post('item/create', [ItemController::class, 'store'])->name('admin.item.store');
    Route::get('item/{item_id}/edit', [ItemController::class, 'edit'])->name('admin.item.edit');
    Route::put('item/{item_id}/edit', [ItemController::class, 'update'])->name('admin.item.update');

    Route::get('location/create', [LocationController::class, 'create'])->name('admin.location.create');
    Route::post('location/create', [LocationController::class, 'store'])->name('admin.location.store');
    Route::get('location/{location_id}/edit', [LocationController::class, 'edit'])->name('admin.location.edit');
    Route::put('location/{location_id}/edit', [LocationController::class, 'update'])->name('admin.location.update');

    Route::get('supplier/create', [SupplierController::class, 'create'])->name('admin.supplier.create');
    Route::post('supplier/create', [SupplierController::class, 'store'])->name('admin.supplier.store');
    Route::get('supplier/{supplier_id}/edit', [SupplierController::class, 'edit'])->name('admin.supplier.edit');
    Route::put('supplier/{supplier_id}/edit', [SupplierController::class, 'update'])->name('admin.supplier.update');

    Route::get('stores/create', [StoreController::class, 'create'])->name('admin.stores.create');
    Route::post('stores/create', [StoreController::class, 'store'])->name('admin.stores.store');
    Route::get('stores/{store_id}/edit', [StoreController::class, 'edit'])->name('admin.stores.edit');
    Route::put('stores/{store_id}/edit', [StoreController::class, 'update'])->name('admin.stores.update');

    Route::get('department/create', [DepartmentController::class, 'create'])->name('admin.department.create');
    Route::post('department/create', [DepartmentController::class, 'store'])->name('admin.department.store');
    Route::get('department/{department_id}/edit', [DepartmentController::class, 'edit'])->name('admin.department.edit');
    Route::put('department/{department_id}/edit', [DepartmentController::class, 'update'])->name('admin.department.update');

    Route::get('orders/create', [OrdersController::class, 'create'])->name('admin.orders.create');
    Route::post('orders/create', [OrdersController::class, 'store'])->name('admin.orders.store');
    Route::get('orders/{order_id}/edit', [OrdersController::class, 'edit'])->name('admin.orders.edit');
    Route::put('orders/{order_id}/edit', [OrdersController::class, 'update'])->name('admin.orders.update');

    Route::get('stock/create', [StockTransactionController::class, 'create'])->name('admin.stock.create');
    Route::post('stock/create', [StockTransactionController::class, 'store'])->name('admin.stock.store');
    Route::get('stock/{transaction_reference}/edit', [StockTransactionController::class, 'edit'])->name('admin.stock.edit');
    Route::put('stock/{transaction_reference}/edit', [StockTransactionController::class, 'update'])->name('admin.stock.update');

});

// Manager Routes (Add, Edit, Delete, View)
Route::prefix('admin')->middleware(['auth:admin', 'manager'])->group(function () {
    //Route::get('employee/{employee_id}/delete', [EmployeeController::class, 'destroy'])->name('admin.employee.delete');
    Route::get('category/{category_id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');
    Route::get('sub_category/{id}/delete', [SubCategoryController::class, 'destroy'])->name('admin.subCategory.delete');
    Route::get('item/{item_id}/delete', [ItemController::class, 'destroy'])->name('admin.item.delete');
    Route::get('location/{location_id}/delete', [LocationController::class, 'destroy'])->name('admin.location.delete');
    Route::get('supplier/{supplier_id}/delete', [SupplierController::class, 'destroy'])->name('admin.supplier.delete');
    Route::get('stores/{store_id}/delete', [StoreController::class, 'destroy'])->name('admin.stores.delete');
    Route::get('department/{department_id}/delete', [DepartmentController::class, 'destroy'])->name('admin.department.delete');
    Route::get('orders/{order_id}/delete', [OrdersController::class, 'destroy'])->name('admin.orders.delete');
    Route::get('stock/{transaction_reference}/delete', [StockTransactionController::class, 'destroy'])->name('admin.stock.delete');

    Route::put('jobs/{job_id}/edit', [JobController::class, 'update'])->name('admin.jobs.update');
    Route::post('jobs/{job_id}/history', [JobHistoryController::class, 'store'])->name('admin.jobs.history.store');


});

// Admin-Only Routes (Full Access)
Route::prefix('admin')->middleware(['auth:admin', 'admin.only'])->group(function () {
    Route::delete('/user/{id}/delete', [AdminController::class, 'destroy'])->name('admin.user.delete');
    Route::delete('jobs/{job_id}/delete', [JobController::class, 'destroy'])->name('admin.jobs.delete');

});

// Management Assistance Role - Can Create and Assign Jobs
Route::prefix('admin')->middleware(['auth:admin', 'management.assistance'])->group(function () {
    Route::get('jobs/create', [JobController::class, 'create'])->name('admin.jobs.create');
    Route::post('jobs/create', [JobController::class, 'store'])->name('admin.jobs.store');
    Route::get('jobs/{job_id}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::put('jobs/{job_id}/edit', [JobController::class, 'update'])->name('admin.jobs.update');
    Route::put('jobs/{job_id}/assign', [JobController::class, 'assignTechnician'])->name('admin.jobs.assign');

});

// Technician Role - Can Update Status and Add Job History
Route::prefix('admin')->middleware(['auth:admin', 'technician'])->group(function () {
    Route::put('jobs/{job_id}/status', [JobController::class, 'updateStatus'])->name('admin.jobs.updateStatus');
    Route::post('jobs/{job_id}/history', [JobHistoryController::class, 'store'])->name('admin.jobs.history.store');
});


Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('jobs/{job_id}', [JobController::class, 'show'])->name('admin.jobs.show');
    Route::get('jobs/{job_id}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');

});


