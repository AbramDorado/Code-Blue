<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $table = 'outcomes';
    protected $primaryKey = 'outcome_id';

    protected $fillable = [
        'outcome',
        'death_dt',
        'bp_systolic',
        'bp_diastolic',
        'heart_rate',
        'respiratory_rate',
        'rhythm', 
    ];

    public function codeBlueActivation()
    {
        return $this->belongsTo(codeBlueActivation::class, 'code_number', 'code_number');
    }
}
