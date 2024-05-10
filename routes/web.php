<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\VehicleController;
use App\Models\SparePart;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return
        view('welcome');
})->name('welcome');

Route::middleware(['auth', 'lang'])->group(function () {

    // dashboard
    Route::get('/', function () {
        return
            view('admin.dashboard');
    })->name('admin.dashboard');

    // routes/web.php

    // appoitment

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('user.appointments');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('store.appointments');
    Route::post('/appointments/distroy', [AppointmentController::class, 'distroy'])->name('distroy.appointments');
    Route::post('/update-appointment-status', [AppointmentController::class, 'updateAppointmentStatus'])->name('update.appointment.status');

    // import data 
    Route::post('/import-users', [ClientController::class, 'importUsers'])->name('import.users');

    // user avatar profile
    Route::post('/upload-avatar', [ClientController::class, 'uploadAvatar'])->name('upload.avatar');

    // graphs
    Route::get('/', [ChartController::class, 'showCharts'])->name('admin.dashboard');


    Route::get('/admins', [AdminController::class, 'showAdmins'])->name('admin.admins');

    // Users
    Route::get('/users', [AdminController::class, 'showUsers'])->middleware(['auth', 'verified'])->name('admin.users');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/users/showModal', [AdminController::class, 'showModal'])->name('users.showModal');
    Route::delete('/users/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/lock-screen', [ClientController::class, 'lockScreen']);
    Route::post('/lock-screen', [ClientController::class, 'unlock'])->name('unlock');

// notificiaotns
Route::get('api/notifications',[RepairController::class,'showNotifications']);
// Route::get('api/notifications',[AppointmentController::class,'showNotifications']);

    // Mechanics
    Route::get('/mechanics', [AdminController::class, 'showMechanics'])->name('admin.mechanics');
    Route::post('/mechanics/showModalMechanic', [AdminController::class, 'showModalMechanic'])->name('admin.showModalMechanic');
    // Route::get('/',[AdminController::class,'mechanicsInfo'])->name('admin.mechanicsInfo');


    // Vehicles
    Route::get('/vehicles', [VehicleController::class, 'showVehicles'])->name('admin.vehicles');
    Route::post('/vehicle/store', [VehicleController::class, 'storeVehicle'])->name('admin.storeVehicle');
    Route::post('/vehicles/showVehiclePics', [VehicleController::class, 'showVehiclePics']);
    Route::put('/vehicles/{id}', [VehicleController::class, 'updateVehicle'])->name('admin.updateVehicle');
    Route::post('/vehicles/destroy', [VehicleController::class, 'destroyVehicle'])->name('admin.destroyVehicle');


    //Repairs
    Route::get('/repairs', [RepairController::class, 'showRepairs'])->name('admin.repairs');
    Route::post('/repairs/store', [RepairController::class, 'storeRepair'])->name('admin.storeRepair');
    Route::get('/getMechanics', [RepairController::class, 'fetchMechanics'])->name('admin.fetchMechanics');
    Route::post('/repairs/destroy', [RepairController::class, 'destroyRepair'])->name('admin.destroyRepair');
    Route::post('/repairs/update-status', [RepairController::class, 'updateRepairStatus'])->name('admin.updateRepairStatus');


    //invoice

    Route::post('/invoices/generate', [InvoiceController::class, 'generateInvoice'])->name('admin.generateInvoice');
    Route::get('/invoices', [InvoiceController::class, 'showInvoices'])->name('admin.Invoices');
    Route::post('/invoices/showModal', [InvoiceController::class, 'showInvoiceModal'])->name('admin.showInvoiceModal');
    Route::post('/invoice/destroy', [InvoiceController::class, 'destroyInvoice'])->name('admin.destroyInvoice');

    Route::post('/generate-pdf', [PDFController::class, 'generatePDF'])->name('invoice.generatePdf');

    //spare parts
    Route::get('/spare-parts', [SparePartController::class, 'showSpareParts'])->name('admin.showSpares');
    Route::post('/spare-parts/add', [SparePartController::class, 'addSparePart'])->name('admin.storeSparePart');
    Route::post('/spare-parts/delete', [SparePartController::class, 'destroySparePart'])->name('admin.destroySparePart');

    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::get('/changeLocale/{locale}', function ($locale) {
        session()->put('locale', $locale);
        return redirect()->back();
    })->name('products.changeLocale');

    // mails 
    Route::get('/send-mail', [MailController::class, 'index']);
    Route::get('/send-mails', [MailController::class, 'sendAll'])->name('admin.sendAll');
    Route::get('/mails', [MailController::class, 'showMails'])->name('admin.mails');

    Route::post('/send-email', [MailController::class, 'sendEmail'])->name('admin.sendEmail');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
