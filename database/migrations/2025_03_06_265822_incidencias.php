<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidencia', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('imagen')->nullable(); // Campo opcional para imágenes
            // Relaciones con usuarios
            $table->unsignedBigInteger('cliente_id'); // Usuario que reporta la incidencia
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tecnico_asignado')->nullable(); // Técnico asignado (puede ser nulo)
            $table->foreign('tecnico_asignado')->references('id')->on('users')->onDelete('cascade');
            // Relaciones con estado, prioridad y categoría
            $table->unsignedBigInteger('estado');
            $table->foreign('estado')->references('id')->on('estado')->onDelete('cascade');
            $table->unsignedBigInteger('prioridad');
            $table->foreign('prioridad')->references('id')->on('prioridad')->onDelete('cascade');
            $table->unsignedBigInteger('categoria');
            $table->foreign('categoria')->references('id')->on('categorias')->onDelete('cascade');
            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidencia');
    }
};