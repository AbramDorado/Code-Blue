<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCRPatient extends Model
{
    use HasFactory;

    protected $table = 'pcr_patients'; // Changed table name to 'medical_information'

    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'full_name',
        'contact_num_p',
        'address_p',
        'sex',
        'age',
        'status',
        'blood_type',
        'comps_name',
        'relationship',
        'address_c',
        'contact_num_c',
    ];
}
