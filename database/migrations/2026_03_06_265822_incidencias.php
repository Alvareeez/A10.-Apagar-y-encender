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
        Schema::create('incidencia', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('subcategoria');
            $table->text('comentario');
            $table->string('imagen')->nullable();
            // RELACION USUARIOS (CREADOR)
            $table->unsignedBigInteger('usuario_creador');
            $table->foreign('usuario_creador')->references('id')->on('users')->onDelete('cascade');
            // RELACION USUARIOS (TECNICO ASIGNADO)
            $table->unsignedBigInteger('tecnico_asignado')->nullable();
            $table->foreign('tecnico_asignado')->references('id')->on('users')->onDelete('cascade');
            // RELACION ESTADO
            $table->unsignedBigInteger('estado');
            $table->foreign('estado')->references('id')->on('estado')->onDelete('cascade');
            // RELACION PRIORIDAD
            $table->unsignedBigInteger('prioridad');
            $table->foreign('prioridad')->references('id')->on('prioridad')->onDelete('cascade');
            // RELACION CATEGORIA
            $table->unsignedBigInteger('categoria');
            $table->foreign('categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencia');
    }
};
