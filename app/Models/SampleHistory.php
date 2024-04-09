<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleHistory extends Model
{
    use HasFactory;

    protected $table = 'sample_history';

    protected $fillable = [
        'signs_symptoms',
        'allergies',
        'medications',
        'past_medical_history',
        'last_oral_intake',
        'event_leading_to_injury',
    ];

    // Define relationship with the Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
