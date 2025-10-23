<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'cpf',
        'birth_date',
        'phone',
        'address',
        'emergency_contact',
        'emergency_phone',
        'allergies',
        'medical_history',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the user that owns the patient profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the photos for the patient.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(PatientPhoto::class);
    }

    /**
     * Get the appointments for the patient.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the profile photo for the patient.
     */
    public function profilePhoto(): HasMany
    {
        return $this->hasMany(PatientPhoto::class)->where('photo_type', 'profile');
    }

    /**
     * Get the evolution photos for the patient.
     */
    public function evolutionPhotos(): HasMany
    {
        return $this->hasMany(PatientPhoto::class)->where('photo_type', 'evolution');
    }
}
