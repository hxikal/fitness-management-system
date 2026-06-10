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
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\TrainerController; // Corrected Path

// Other Controllers
use App\Http\Controllers\FeedbackController;
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

// Admin login
Route::get('/admin/login', [AdminLoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');

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

    Route::post('/membership/renew', [MembershipController::class, 'renew'])->name('membership.renew');

    Route::get('/verify-member/{token}', function ($token) {
        //
    })->name('member.verify');

    Route::get('/equipment-report', [EquipmentReportController::class, 'index'])->name('equipment.report.index');
    Route::post('/equipment-report/store', [EquipmentReportController::class, 'store'])->name('equipment.report.store');
    Route::put('equipment-report/update/{id}', [EquipmentReportController::class, 'update'])->name('equipment.report.update');
    Route::delete('/equipment-report/delete/{id}', [EquipmentReportController::class, 'destroy'])->name('equipment.report.delete');

    Route::get('/payment-history', [PaymentController::class, 'index'])->name('payment_history');

    Route::get('/fitnesstrainer', [FitnessTrainerController::class, 'index'])->name('fitnesstrainer');
    Route::post('/fitnesstrainer/store', [FitnessTrainerController::class, 'store'])->name('fitnesstrainer.store');
    Route::put('/fitnesstrainer/update/{id}', [FitnessTrainerController::class, 'update'])->name('fitnesstrainer.update');
    Route::delete('/fitnesstrainer/delete/{id}', [FitnessTrainerController::class, 'destroy'])->name('fitnesstrainer.delete');

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index.user');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::delete('/feedback/{id}', [FeedbackController::class, 'delete'])->name('feedback.delete');
});


/* --- TRAINER MODULE --- */

Route::middleware(['auth:trainer'])->group(function () {
    Route::get('/trainer/dashboard', [TrainerDashboardController::class, 'index'])->name('trainer.dashboard');
});

/* --- 3. ADMIN MODULE --- */

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/trainer-bookings', [AdminTrainerBookingController::class, 'index'])->name('trainer_bookings.index');
        Route::patch('/trainer-bookings/{id}/status', [AdminTrainerBookingController::class, 'updateStatus'])->name('trainer_bookings.status');
        Route::delete('/trainer-bookings/{id}', [AdminTrainerBookingController::class, 'destroy'])->name('trainer-bookings.destroy');

        Route::get('trainers-list', [AdminAuthController::class, 'showTrainers'])->name('trainers.index');
        Route::delete('trainers/{id}', [TrainerController::class, 'destroy'])->name('trainers.destroy');

        Route::get('/equipment-reports', [AdminEquipmentController::class, 'index'])->name('equipment.index');

        Route::get('/members', [AdminMembershipController::class, 'index'])->name('members.index');

        // FIXED VERIFY ROUTE
        Route::post('/members/{id}/verify', [AdminMembershipController::class, 'verify'])
            ->name('members.verify');

        Route::delete('/members/{id}', [AdminMembershipController::class, 'delete'])->name('members.delete');

        Route::post('/members/{id}/renew', [AdminMembershipController::class, 'renew'])->name('admin.members.renew');

        Route::get('/member/scan/{id}', [AdminMembershipController::class, 'scanMember'])
            ->name('admin.member.scan');

        Route::get('/members/{id}/activate', [AdminMembershipController::class, 'activateMembership'])
            ->name('members.activate');

        Route::get('/payments-report', [AdminPaymentController::class, 'index'])->name('payments.index');
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