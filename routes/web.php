<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Trainer;

// Admin Module Controllers
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\AdminTrainerController;
use App\Http\Controllers\Admin\AdminTrainerBookingController;
use App\Http\Controllers\Admin\AdminMembershipController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminEquipmentController;
use App\Http\Controllers\Admin\TrainerController; // Corrected Path

// Other Controllers
use App\Http\Controllers\FitnessTrainerController;
use App\Http\Controllers\EquipmentReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\TrainerDashboardController;
use App\Http\Controllers\TrainerAuthController;
use App\Http\Controllers\TrainerSessionController;



/* --- 1. PUBLIC AUTH ROUTES --- */

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');

/* --- TRAINER LOGIN ROUTES --- */
Route::get('/trainer/login', [TrainerAuthController::class, 'showLoginForm'])->name('trainer.login');
Route::post('/trainer/login', [TrainerAuthController::class, 'login'])->name('trainer.login.submit');
Route::post('/trainer/logout', [TrainerAuthController::class, 'logout'])->name('trainer.logout');
Route::get('/trainer/register', [TrainerAuthController::class, 'showRegisterForm'])
    ->name('trainer.register');

Route::post('/trainer/register', [TrainerAuthController::class, 'register'])->name('trainer.register.submit');

// Admin login
Route::get('/admin/login', [AdminLoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');

// Admin logout
Route::post('/admin/logout', [AdminLoginController::class, 'adminLogout'])->name('admin.logout');

/* --- FORGOT PASSWORD SYSTEM --- */

Route::get('/forgot-password', function () {
    return view('forgot_password'); 
})->name('password.request');

Route::get('/reset-password/{token}', function ($token) {
    return view('reset_password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();
    if ($user) {
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('password.success'); 
    }
    return back()->with('error', 'Emel tidak dijumpai.');
})->name('password.update');

Route::get('/password-updated', function () {
    return view('auth.success');
})->name('password.success');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login'); 
})->name('logout');

/* --- REGISTRATION LOGIC --- */

Route::get('/register', function () {
    return view('registerblade'); 
})->name('register');

Route::post('/register/annual', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_active' => 0,
        'membership_start' => null,
        'membership_expiry' => null,
        'role' => 'user',
        'type' => 'annual',
    ]);

    return redirect()->route('login')->with('status', 'Annual Registration Successful!');
})->name('register.annual.submit');


Route::post('/register/monthly', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_active' => 0,
        'membership_start' => null,
        'membership_expiry' => null,
        'role' => 'user',
        'type' => 'monthly',
    ]);

    return redirect()->route('login')->with('status', 'Registration Successful!');
})->name('register.monthly.submit');


Route::post('/register/walkin', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'no_telefon' => 'required|string|max:15',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'no_telefon' => $request->no_telefon,
        'is_active' => 0,
        'membership_start' => null,
        'membership_expiry' => null,
        'role' => 'user',
        'type' => 'walk-in',
    ]);

    return redirect()->route('login')->with('status', 'Registration Successful!');
})->name('register.walkin.submit');


/* --- 2. USER MODULE --- */

Route::middleware(['auth:web', 'role:user'])->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('userdashboard');

    Route::get('/membership-info', function () {
        return view('membershipinfoblade');
    })->name('membership.info');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


   Route::get('/verify-member/{id}', [MembershipController::class, 'verifyMembership'])
    ->name('member.verify');
    Route::get('/equipment-report', [EquipmentReportController::class, 'index'])->name('equipment.report.index');
    Route::post('/equipment-report/store', [EquipmentReportController::class, 'store'])->name('equipment.report.store');
    Route::put('equipment-report/update/{id}', [EquipmentReportController::class, 'update'])->name('equipment.report.update');
    Route::delete('/equipment-report/delete/{id}', [EquipmentReportController::class, 'destroy'])->name('equipment.report.delete');

   Route::get('/payment-history', [PaymentController::class, 'index'])
    ->name('payment_history');
   Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::post('/payment/upload-receipt', [PaymentController::class, 'uploadReceipt'])->name('payment.upload.receipt');


Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.return');

    Route::get('/fitnesstrainer', [FitnessTrainerController::class, 'index'])->name('fitnesstrainer');
    Route::post('/fitnesstrainer/store', [FitnessTrainerController::class, 'store'])->name('fitnesstrainer.store');
    Route::put('/fitnesstrainer/update/{id}', [FitnessTrainerController::class, 'update'])->name('fitnesstrainer.update');
    Route::delete('/fitnesstrainer/delete/{id}', [FitnessTrainerController::class, 'destroy'])->name('fitnesstrainer.delete');

});


/* --- TRAINER MODULE --- */

Route::middleware(['auth:trainer'])->group(function () {
    Route::get('/trainer/dashboard', [TrainerDashboardController::class, 'index'])->name('trainer.dashboard');

    
});

Route::get('/trainer/sessions', [TrainerSessionController::class, 'index'])
    ->name('trainer.session.index');

Route::get('/trainer/profile', [FitnessTrainerController::class, 'profile'])
    ->name('trainer.profile');

Route::put('/trainer/profile/{id}', [FitnessTrainerController::class, 'updateProfile'])
    ->name('trainer.profile.update');

Route::post('/trainer/availability', [TrainerSessionController::class, 'storeAvailability'])
    ->name('trainer.availability.store');

Route::get('/trainer/events', [TrainerSessionController::class, 'getEvents'])->name('trainer.events');

Route::delete('/trainer/availability/{id}', [TrainerSessionController::class, 'destroyAvailability'])
    ->name('trainer.availability.destroy');

Route::get('/trainers/availability/{trainerName}', [TrainerSessionController::class, 'getTrainerAvailability'])->name('trainers.availability');
   
Route::get('/trainer/availability-table', [TrainerSessionController::class, 'getAvailabilityTable']);

 Route::delete('/trainer/availability/{id}', [TrainerSessionController::class, 'destroyAvailability']);


Route::put('/trainer/bookings/{id}/status', [AdminTrainerBookingController::class, 'updateStatus'])
    ->name('trainer.bookings.updateStatus');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])
            ->name('dashboard');

        // FIXED: GET -> POST
        Route::post('/logout', function () {

            Auth::guard('admin')->logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect('/login');

        })->name('logout');

        Route::get('/trainer-bookings', [AdminTrainerBookingController::class, 'index'])
            ->name('trainer_bookings.index');

        Route::patch('/trainer-bookings/{id}/status', [AdminTrainerBookingController::class, 'updateStatus'])
            ->name('trainer_bookings.status');

        Route::delete('/trainer-bookings/{id}', [AdminTrainerBookingController::class, 'destroy'])
            ->name('trainer-bookings.destroy');

        Route::get('trainers-list', [AdminAuthController::class, 'showTrainers'])
            ->name('trainers.index');

        Route::delete('trainers/{id}', [TrainerController::class, 'destroy'])
            ->name('trainers.destroy');

        Route::get('/equipment-reports', [AdminEquipmentController::class, 'index'])
            ->name('equipment.index');

        Route::put('/equipment-reports/{id}/status', [AdminEquipmentController::class, 'update'])
            ->name('equipment.update');

        Route::delete('/equipment-reports/{id}', [AdminEquipmentController::class, 'destroy'])
            ->name('equipment.destroy');

        Route::get('/members', [AdminMembershipController::class, 'index'])
            ->name('members.index');

        Route::delete('/members/{id}', [AdminMembershipController::class, 'delete'])
            ->name('members.delete');

        Route::post('/members/{id}/renew', [AdminMembershipController::class, 'renew'])
            ->name('members.renew');

       Route::post('/members/{id}/activate', [AdminMembershipController::class, 'activateMembership'])
    ->name('members.activate');

        Route::get('/payments-report', [AdminPaymentController::class, 'index'])
            ->name('payments.index');

        Route::get('/payments', [AdminPaymentController::class, 'index'])
            ->name('admin.payments');

        Route::post('/payments/{id}/approve', [AdminPaymentController::class, 'approve'])
            ->name('payments.approve');

        Route::delete('/payments/{id}/delete', [AdminPaymentController::class, 'deleteReceipt'])
            ->name('payments.delete');

        Route::delete('/payments/{id}/destroy', [AdminPaymentController::class, 'destroy'])
            ->name('payments.destroy');
    });

});
// Note: trainer.logout is already defined above (line 47) — duplicate removed here

/*
Route::get('/fix-trainer-passwords', function() {
    $ahmad = Trainer::find(1);
    if($ahmad) {
        $ahmad->password = Hash::make('123456');
        $ahmad->save();
    }

    $sarah = Trainer::find(2);
    if($sarah) {
        $sarah->password = Hash::make('sarah123');
        $sarah->save();
    }

    return "Trainer passwords updated securely via Laravel!";
});
*/
