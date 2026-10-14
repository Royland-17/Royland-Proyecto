<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['codigo', 'nombre'];

    public function grupos(): HasMany
    {
        return $this->hasMany(Grupo::class, 'curso_codigo', 'codigo');
    }
}