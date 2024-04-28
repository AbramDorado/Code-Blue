<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSigns extends Model
{
    protected $table = 'vital_signs'; // Changed table name to 'medical_information'

    protected $primaryKey = 'vital_signs_id';

    protected $fillable = [
        'vs_1st_time',
        'blood_pressure1',
        'respiratory_rate1',
        'pulse_rate1',
        'oxygen_sat1',
        'skin_color1',
        'skin_temp1',
        'vs_2nd_time',
        'blood_pressure2',
        'respiratory_rate2',
        'pulse_rate2',
        'oxygen_sat2',
        'skin_color2',
        'skin_temp2',
        'vs_3rd_time',
        'blood_pressure3',
        'respiratory_rate3',
        'pulse_rate3',
        'oxygen_sat3',
        'skin_color3',
        'skin_temp3',
        'vs_4th_time',
        'blood_pressure4',
        'respiratory_rate4',
        'pulse_rate4',
        'oxygen_sat4',
        'skin_color4',
        'skin_temp4',
    ];

    // Define relationship with the Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
