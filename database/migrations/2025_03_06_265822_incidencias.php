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
            $table->string('imagen');
            //REALCION USUARIOS
            $table->unsignedBigInteger('tecnico_asignado');
            $table->foreign('tecnico_asignado')->references('id')->on('users')->onDelete('cascade');
            // RELACION ESTADO
            $table->unsignedBigInteger('estado');
            $table->foreign('estado')->references('id')->on('estado')->onDelete('cascade');
            // RELACION PRIORIDAD
            $table->unsignedBigInteger('prioridad');
            $table->foreign('prioridad')->references('id')->on('prioridad')->onDelete('cascade');
            // RELACION SUBCATEGORIA
            $table->unsignedBigInteger('subcategoria');
            $table->foreign('subcategoria')->references('id')->on('subcategorias')->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
