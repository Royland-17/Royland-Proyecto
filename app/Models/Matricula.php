<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Matricula extends Pivot
{
    protected $table = 'matriculas';

    protected $fillable = [
        'estudiante_id',
        'grupo_id',
        'fecha',
        'nota_final',
    ];
}
