<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientPhoto extends Model
{
    protected $fillable = [
        'patient_id',
        'photo_path',
        'photo_type',
        'description',
        'weight',
        'photo_date',
    ];

    protected $casts = [
        'photo_date' => 'date',
        'weight' => 'decimal:2',
    ];

    /**
     * Get the patient that owns the photo.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the photo URL.
     */
    public function getPhotoUrlAttribute(): string
    {
        return asset('storage/' . $this->photo_path);
    }
}
