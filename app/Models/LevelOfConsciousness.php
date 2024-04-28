<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelOfConsciousness extends Model
{
    use HasFactory;

    protected $table = 'level_of_consciousness'; // Changed table name to 'medical_information'

    protected $primaryKey = 'level_of_consciousness_id';

    protected $fillable = [
        'loc_baseline_time',
        'status_baseline',
        'loc_2nd_time',
        'status2',
        'loc_3rd_time',
        'status3',
        'loc_4th_time',
        'status4',
    ];

    // Define relationship with the Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
