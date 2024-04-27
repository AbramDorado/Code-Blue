<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HTAssessment extends Model
{
    use HasFactory;

    protected $table = 'h_t_assessment'; // Changed table name to 'medical_information'

    protected $primaryKey = 'h_t_assessment_id';

    protected $fillable = [
        'head',
        'shoulders',
        'arms',
        'body',
        'legs',
        'toes',
    ];

    // Define relationship with the Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
