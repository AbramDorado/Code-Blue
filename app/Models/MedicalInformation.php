<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInformation extends Model
{
    use HasFactory;

    protected $table = 'medical_information'; // Changed table name to 'medical_information'

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
        'team',
        'plate_num',
        'driver',
        'reporter',
        'cameraman',
        'team_leader',
        'crew1',
        'crew2',
        'crew3',
        'crew4',
        'departure_base_time',
        'arrival_scene_time',
        'arrival_hospital_time',
        'departure_hospital_time',
        'arrival_base_time',
        'incident_dt',
        'location',
        'incident_type',
        'nature_of_incident',
        'remarks',
    ];

}
