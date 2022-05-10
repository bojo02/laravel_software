<?php

use Illuminate\Support\Facades\Route;
//CONTROLLERS
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SignaturePadController;


//MIDDLEWARE
use App\Http\Middleware\access_sales;
use App\Http\Middleware\AdminAccess;

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

require __DIR__.'/auth.php';

//IF THE USER IS LOGGED

Route::middleware(['web', 'auth'])->group(function () {
    //HOME
    Route::get('/', [OrderController::class, 'index'])->name('home');

    //USER CONTROLS
    Route::resource('user', UserController::class);
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    //NOTE CONTROLS
    Route::resource('note', NoteController::class);

    //ORDER CONTROLS
    Route::post('order/upload-install-photo{id}', [OrderController::class, 'storeInstallImage'])->name('order.store.install.photo');
    Route::post('order/upload-confirmation-photo{id}', [OrderController::class, 'storeResultImage'])->name('order.storeResultImage');
    Route::post('order/storefile/{id}', [OrderController::class, 'saveFile'])->name('order.store.file');
    Route::post('order/storedesign/{id}', [OrderController::class, 'saveDesign'])->name('order.store.design');
    Route::get('order/review/{id}', [OrderController::class, 'review'])->name('order.review');
    Route::get('order/sendNewReview/{id}', [OrderController::class, 'sendNewReview'])->name('order.sendNewReview');
    Route::get('order/designConfirm/{id}', [OrderController::class, 'designConfirm'])->name('order.designConfirm');
    Route::get('order/lastDesign/{id}', [OrderController::class, 'lastDesign'])->name('order.lastDesign');
    Route::get('order/lastPrint/{id}', [OrderController::class, 'lastPrint'])->name('order.lastPrint');
    Route::get('order/sendToStorage/{id}', [OrderController::class, 'sendToStorage'])->name('order.sendToStorage');
    Route::get('order/sendToInstall/{id}', [OrderController::class, 'sendToInstall'])->name('order.sendToInstall');
    Route::get('order/sendToClient/{id}', [OrderController::class, 'sendToClient'])->name('order.sendToClient');
    Route::get('order/installReview/{id}', [OrderController::class, 'installReview'])->name('order.installReview');
    Route::get('order/done/{id}', [OrderController::class, 'done'])->name('order.done');
    Route::get('order/sendToPrinter/{id}', [OrderController::class, 'sendToPrinter'])->name('order.sendToPrinter');
    Route::get('order/search', [OrderController::class, 'searchOrders'])->name('order.search');
    Route::resource('order', OrderController::class);

    //ADMIN CONTROLS
    Route::get('admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('admin/invoice/destroy/{id}', [AdminController::class, 'destroyInvoice'])->name('admin.destroy.invoice');
    Route::get('admin/users/{id}', [AdminController::class, 'user'])->name('admin.user');
    Route::post('admin/user/update/{id}', [AdminController::class, 'userUpdate'])->name('admin.userUpdate');
    Route::post('admin/user/password/update/{id}', [AdminController::class, 'userPasswordUpdate'])->name('admin.user.password.pdate');
    Route::get('admin/new/user', [AdminController::class, 'newUser'])->name('admin.new.user');
    Route::post('admin/user/store', [AdminController::class, 'storeUser'])->name('admin.store.user');
    Route::get('admin/orders', [AdminController::class, 'allOrders'])->name('admin.orders');
    Route::get('admin/invoices', [AdminController::class, 'allInvoices'])->name('admin.invoices');
    Route::get('admin/invoices/search', [AdminController::class, 'searchInvoices'])->name('admin.invoices.search');
    Route::get('admin/orders/search', [AdminController::class, 'searchOrders'])->name('admin.orders.search');
    Route::post('admin/order/change/status/{id}', [AdminController::class, 'changeStatus'])->name('admin.change.status');
    Route::get('admin/cash-register', [AdminController::class, 'cashRegister'])->name('admin.cash-register');
    Route::get('admin/invoice{id}', [AdminController::class, 'invoiceShow'])->name('admin.show.invoice');
    Route::get('admin/invoices/dates', [AdminController::class, 'invoicesDates'])->name('admin.invoices.dates');
    Route::get('admin/expenses/dates', [AdminController::class, 'expensesDates'])->name('admin.expenses.dates');

    //EXPENSE CONTROLS
    Route::resource('expense', ExpenseController::class);

      

Route::get('signaturepad', [SignaturePadController::class, 'index']);

Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');
});