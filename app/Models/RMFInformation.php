<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RMFInformation extends Model
{
    use HasFactory;

    protected $table = 'r_m_f_information'; // Changed table name to 'medical_information'

    protected $primaryKey = 'r_m_f_information_id';

    protected $fillable = [
        'hospital_name',
        'doctor_name',
    ];

    // Define relationship with the Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
