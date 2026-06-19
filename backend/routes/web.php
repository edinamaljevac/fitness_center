<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Trainer\TrainerDashboardController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Admin\AttendanceController;
use \App\Http\Controllers\Member\MemberProfileController;
use \App\Http\Controllers\Trainer\TrainerProfileController;
use App\Http\Controllers\Trainer\TrainerSlotController;
use App\Http\Controllers\Trainer\TrainerGroupTrainingController;
use \App\Http\Controllers\Member\RegistrationController;
use App\Http\Controllers\GroupRegistrationController;
use \App\Http\Controllers\Trainer\TrainerMemberController;
use App\Http\Controllers\Admin\ExerciseController;
use App\Http\Controllers\Admin\AdminReportsController;
use App\Http\Controllers\Trainer\TrainerTrainingController;



use App\Http\Controllers\SlotReservationController;




Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/members', [MemberController::class, 'index'])
            ->name('members.index');

        Route::get('/members/{member}', [MemberController::class, 'show'])
            ->name('members.show');

        Route::patch('/members/{member}/status', [MemberController::class, 'updateStatus'])
            ->name('members.updateStatus');

        Route::get('/packages', [PackageController::class, 'index'])
            ->name('packages.index');

        Route::get('/packages/create', [PackageController::class, 'create'])
            ->name('packages.create');

        Route::post('/packages', [PackageController::class, 'store'])
            ->name('packages.store');

        Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])
            ->name('packages.edit');

        Route::put('/packages/{package}', [PackageController::class, 'update'])
            ->name('packages.update');

        Route::patch('/packages/{package}/toggle', [PackageController::class, 'toggle'])
            ->name('packages.toggle');

        Route::resource('exercises', ExerciseController::class);

        Route::get('/memberships', [MembershipController::class, 'index'])
            ->name('memberships.index');

        Route::get('/memberships/create', [MembershipController::class, 'create'])
            ->name('memberships.create');

        Route::post('/memberships', [MembershipController::class, 'store'])
            ->name('memberships.store');

        Route::get('/memberships/{membership}', [MembershipController::class, 'show'])
            ->name('memberships.show');

        Route::patch('/memberships/{membership}/deactivate', [MembershipController::class, 'deactivate'])
            ->name('memberships.deactivate');


        Route::get('/payments', [PaymentController::class, 'index'])
            ->name('payments.index');

        Route::get('/payments/create', [PaymentController::class, 'create'])
            ->name('payments.create');

        Route::post('/payments', [PaymentController::class, 'store'])
            ->name('payments.store');

        Route::get('/payments/{payment}', [PaymentController::class, 'show'])
            ->name('payments.show');

        Route::post('/members/{member}/check-in', [AttendanceController::class, 'checkIn'])
            ->name('attendances.checkIn');

        Route::patch('/attendances/{attendance}/check-out', [AttendanceController::class, 'checkOut'])
            ->name('attendances.checkOut');


        Route::get('/reservations', [AdminDashboardController::class, 'reservations'])
            ->name('reservations.index');

        Route::get('/group-registrations', [AdminDashboardController::class, 'groupRegistrations'])
            ->name('group.index');



        Route::patch('/reservations/{reservation}/approve', [SlotReservationController::class, 'approve'])
            ->name('reservations.approve');

        Route::patch('/reservations/{reservation}/reject', [SlotReservationController::class, 'reject'])
            ->name('reservations.reject');

        Route::patch('/group-registrations/{registration}/approve', [GroupRegistrationController::class,'approve'])
            ->name('group.approve');

        Route::patch('/group-registrations/{registration}/reject', [GroupRegistrationController::class,'reject'])
            ->name('group.reject');

        Route::get('/reports', [AdminReportsController::class, 'index'])
            ->name('reports');
});



Route::middleware(['auth', 'role:trainer'])
    ->prefix('trainer')
    ->name('trainer.')
    ->group(function () {

        Route::get('/dashboard', [TrainerDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/profile', [TrainerProfileController::class, 'edit'])
            ->name('profile');

        Route::patch('/profile', [TrainerProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('/slots', [TrainerSlotController::class, 'index'])
            ->name('slots.index');

        Route::get('/slots/create', [TrainerSlotController::class, 'create'])
            ->name('slots.create');

        Route::post('/slots', [TrainerSlotController::class, 'store'])
            ->name('slots.store');

        Route::get('/group-trainings', [TrainerGroupTrainingController::class, 'index'])
            ->name('group.index');

        Route::get('/group-trainings/create', [TrainerGroupTrainingController::class, 'create'])
            ->name('group.create');

        Route::post('/group-trainings', [TrainerGroupTrainingController::class, 'store'])
            ->name('group.store');

        Route::get('/members', [TrainerMemberController::class, 'index'])
            ->name('members.index');

        Route::get('/members/{member}', [TrainerMemberController::class, 'show'])
            ->name('members.show');

         Route::get('/members/{member}/progress/create', [TrainerMemberController::class, 'createProgress'])
            ->name('progress.create');

        Route::post('/members/{member}/progress', [TrainerMemberController::class, 'storeProgress'])
            ->name('progress.store');


        Route::get('/trainings', [TrainerTrainingController::class, 'index'])
            ->name('trainings.index');

        Route::get('/trainings/{training}/edit', [TrainerTrainingController::class, 'edit'])
            ->name('trainings.edit');

        Route::put('/trainings/{training}', [TrainerTrainingController::class, 'update'])
            ->name('trainings.update');
        });

Route::middleware(['auth', 'role:member'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {

        Route::get('/dashboard', [MemberDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/attendances', [MemberDashboardController::class, 'attendances'])
            ->name('attendances');

        Route::get('/profile', [MemberProfileController::class, 'edit'])
            ->name('profile');

        Route::patch('/profile', [MemberProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('/personal-trainings', [MemberDashboardController::class, 'slots'])
            ->name('personal.index');


        Route::post('/slots/{slot}/reserve', [SlotReservationController::class, 'store'])
            ->name('slots.reserve');

        Route::get('/group-trainings', [MemberDashboardController::class,'groupTrainings'])
            ->name('group.index');

        Route::post('/group-trainings/{group}/apply', [GroupRegistrationController::class,'store'])
            ->name('group.apply');

        Route::get('/my-trainings', [MemberDashboardController::class, 'myTrainings'])
            ->name('trainings.index');

        Route::patch('/trainings/{training}/rate', [MemberDashboardController::class, 'rateTraining'])
            ->name('trainings.rate');

        Route::delete('/reservations/{reservation}', [SlotReservationController::class,'cancel'])
            ->name('reservations.cancel');

        Route::get('/my-trainings/{training}', [MemberDashboardController::class, 'showTraining'])
            ->name('trainings.show');

        Route::get('/progress', [MemberDashboardController::class, 'progress'])
            ->name('progress.index');

});
