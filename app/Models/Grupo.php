<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = ['numero', 'cupo', 'curso_codigo', 'docente_id'];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_codigo', 'codigo');
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }

    public function estudiantes(): BelongsToMany
    {
        return $this->belongsToMany(Estudiante::class, 'matriculas', 'grupo_id', 'estudiante_id')
                    ->using(Matricula::class)
                    ->withPivot('fecha', 'nota_final')
                    ->withTimestamps();
    }
}
