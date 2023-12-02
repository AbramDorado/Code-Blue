<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialResuscitation extends Model
{
    use HasFactory;
    protected $table = 'initial_resuscitations';
    protected $primaryKey = 'initial_resuscitation_id';

    protected $fillable = [
        'breathing_upon_ca',
        'first_ventilation_dt',
        'ventilation',
        'other_ventilation',
        'intubation_dt',
        'et_tube_size',
        'intubation_attempts',
        'et_tube_information',
        'first_documented_rhythm_dt',
        'first_pulseless_rhythm_dt',
        'compressions_dt',
        'aed_applied',
        'aed_applied_dt',
        'pacemaker_on',
        'pacemaker_on_dt',
        'pacemaker_on',
        'code_number',
    ];

    public function codeBlueActivation()
    {
        return $this->belongsTo(codeBlueActivation::class, 'code_number', 'code_number');
    }

    
}
