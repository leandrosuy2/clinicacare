<?php

use Illuminate\Support\Facades\Route;

// Redirecionamento automático baseado no status de autenticação
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Patient Profile Routes
Route::middleware(['auth'])->group(function () {
    // Patient's own profile
    Route::get('patient-profile', function () {
        if (auth()->user()->isPatient()) {
            return view('patient.profile');
        }
        return redirect()->route('dashboard');
    })->name('patient.profile');
    
    // Doctor's patient list
    Route::get('patients', function () {
        if (auth()->user()->isDoctor()) {
            return view('doctor.patients');
        }
        return redirect()->route('dashboard');
    })->name('doctor.patients');
    
    // Doctor's patient details
    Route::get('patients/{id}', function ($id) {
        if (auth()->user()->isDoctor()) {
            return view('doctor.patient-details', ['patientId' => $id]);
        }
        return redirect()->route('dashboard');
    })->name('doctor.patient-details');
    
    // Photo upload routes
    Route::post('photos/upload', [App\Http\Controllers\PatientPhotoController::class, 'store'])->name('photos.upload');
    Route::get('patients/{patientId}/photos', [App\Http\Controllers\PatientPhotoController::class, 'index'])->name('photos.index');
    Route::delete('photos/{photoId}', [App\Http\Controllers\PatientPhotoController::class, 'destroy'])->name('photos.destroy');
    
    // Appointment routes
    Route::post('appointments', [App\Http\Controllers\AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('patients/{patientId}/appointments', [App\Http\Controllers\AppointmentController::class, 'index'])->name('appointments.index');
    Route::put('appointments/{appointmentId}/status', [App\Http\Controllers\AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
    Route::get('appointments/today', [App\Http\Controllers\AppointmentController::class, 'today'])->name('appointments.today');
});

require __DIR__.'/auth.php';
