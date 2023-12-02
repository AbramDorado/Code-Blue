<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    protected $primaryKey = 'evaluation_id';

    protected $fillable = [
        'question1',
        'question2',
        'question2_1',
        'question3',
        'question3_1',
        'question3_2',
        'question3_3',
        'question3_4',
        'question3_5',
        'question3_6',
        'question3_7',
        'question3_8',
        'question3_9',
        'question3_10',
        'question3_11',
        'question3_12',
        'question3_13',
        'question3_14',
        'question4',
        'question4_1',
        'question5',
        'question5_1',
        'question6',
        'question7',
        'code_number',

    ];
    public $timestamps = true;

    public function codeBlueActivation()
    {
        return $this->belongsTo(codeBlueActivation::class, 'code_number', 'code_number');
    }
}
