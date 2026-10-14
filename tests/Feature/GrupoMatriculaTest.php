<?php

namespace Tests\Feature;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Estudiante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GrupoMatriculaTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_crear_un_curso_un_grupo_con_docente_y_estudiantes()
    {
        // 1. Crear el Curso (cumpliendo con la composición)
        $curso = Curso::create([
            'codigo' => 'IF1300',
            'nombre' => 'Ingeniería de Software I'
        ]);

        // 2. Crear el Docente que imparte el grupo
        $docente = Docente::create([
            'nombre' => 'Dr. Carlos Pérez'
        ]);

        // 3. Crear el Grupo asociado al curso y al docente
        $grupo = Grupo::create([
            'numero' => 1,
            'cupo' => 30,
            'curso_codigo' => $curso->codigo,
            'docente_id' => $docente->id
        ]);

        // 4. Crear dos estudiantes
        $estudiante1 = Estudiante::create(['nombre' => 'Ana Gómez']);
        $estudiante2 = Estudiante::create(['nombre' => 'Luis Rodríguez']);

        // 5. Matricular a los dos estudiantes en el grupo (usando la clase de asociación)
        $grupo->estudiantes()->attach($estudiante1->id, [
            'fecha' => '2026-10-15',
            'nota_final' => 95.5
        ]);

        $grupo->estudiantes()->attach($estudiante2->id, [
            'fecha' => '2026-10-15',
            'nota_final' => 88.0
        ]);

        // 6. Aserciones para verificar que todo se creó correctamente
        $this->assertCount(1, $curso->grupos);
        $this->assertEquals('Dr. Carlos Pérez', $grupo->docente->nombre);
        $this->assertCount(2, $grupo->estudiantes);
    }
}