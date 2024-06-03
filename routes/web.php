<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\VehicleController;
use App\Models\SparePart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'lang'])->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class,'getInfos'])->name('admin.dashboard');
    Route::get('/admins', [AdminController::class, 'listAdmins'])->name('admin.admins')->middleware('admin');

    // appointments
    Route::get('/appointments', [AppointmentController::class, 'listAppointments'])->name('user.appointments');
    Route::post('/appointments', [AppointmentController::class, 'createAppointment'])->name('store.appointments');
    Route::post('/appointments/destroy', [AppointmentController::class, 'deleteAppointment'])->name('destroy.appointments');
    Route::post('/update-appointment-status', [AppointmentController::class, 'changeAppointmentStatus'])->name('update.appointment.status');

    // import data 
    Route::post('/import-users', [ClientController::class, 'uploadUsers'])->name('import.users');
    Route::get('/export-clients', [ClientController::class, 'exportClients'])->name('export.clients');
    Route::get('/export-mechanics', [ClientController::class, 'exportMechanics'])->name('export.mechanics');

    // Users
    Route::get('/usersAdd', [AdminController::class, 'createUser'])->middleware(['auth', 'verified'])->name('admin.addUser');
    Route::get('/users', [AdminController::class, 'listUsers'])->middleware(['auth', 'verified'])->name('admin.users');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.store');
    Route::put('/users/{clientId}', [AdminController::class, 'modifyUser'])->name('admin.update');
    Route::post('/users/showModal', [AdminController::class, 'fetchUserDetails'])->name('users.showModal');
    Route::post('/users/destroy', [AdminController::class, 'removeUser'])->name('admin.destroy');

    // Mechanics
    Route::get('/mechanics', [AdminController::class, 'listMechanics'])->name('admin.mechanics');

    // Vehicles
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('admin.vehicles');
    Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('admin.storeVehicle');
    Route::post('/vehicles/showVehiclePics', [VehicleController::class, 'showVehiclePics']);
    Route::put('/vehicles/{vehicleId}', [VehicleController::class, 'update'])->name('admin.updateVehicle');
    Route::post('/vehicles/destroy', [VehicleController::class, 'destroy'])->name('admin.destroyVehicle');

    // Repairs
    Route::get('/repairs', [RepairController::class, 'index'])->name('admin.repairs');
    Route::post('/repairs/store', [RepairController::class, 'create'])->name('admin.storeRepair');
    Route::get('/getMechanics', [RepairController::class, 'getMechanics'])->name('admin.fetchMechanics');
    Route::post('/repairs/destroy', [RepairController::class, 'delete'])->name('admin.destroyRepair');
    Route::post('/repairs/update-status', [RepairController::class, 'updateStatus'])->name('admin.updateRepairStatus');

    // Invoices
    Route::get('/invoices', [InvoiceController::class, 'showInvoices'])->name('admin.Invoices');
    Route::post('/invoices/generate', [InvoiceController::class, 'generateInvoice'])->name('admin.generateInvoice');
    Route::post('/invoice/destroy', [InvoiceController::class, 'destroyInvoice'])->name('admin.destroyInvoice');
    Route::get('/generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('pdf');

    // Spare parts
    Route::get('/spare-parts', [SparePartController::class, 'index'])->name('admin.showSpares');
    Route::post('/spare-parts/add', [SparePartController::class, 'create'])->name('admin.storeSparePart');
    Route::post('/spare-parts/delete', [SparePartController::class, 'delete'])->name('admin.destroySparePart');

    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

    Route::get('/changeLocale/{locale}', function ($locale) {
        session()->put('locale', $locale);
        return redirect()->back();
    })->name('products.changeLocale');

    // Mails 
    Route::get('/send-mail', [MailController::class, 'index']);
    Route::get('/send-mails', [MailController::class, 'sendAllEmails'])->name('admin.sendAll');
});

require __DIR__ . '/auth.php';
