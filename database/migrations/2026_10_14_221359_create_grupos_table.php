<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('grupos', function (Blueprint $table) {
    $table->id();
    $table->integer('numero');
    $table->integer('cupo');
    $table->string('curso_codigo');
    $table->foreign('curso_codigo')->references('codigo')->on('cursos')->onDelete('cascade');
    $table->foreignId('docente_id')->constrained('docentes')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
