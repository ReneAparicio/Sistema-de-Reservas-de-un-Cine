<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcion_id')->constrained('funciones')->onDelete('cascade');
            $table->string('cliente_nombre', 100);
            $table->string('cliente_email', 100);
            $table->integer('cantidad_asientos');
            $table->string('codigo_reserva', 50)->unique();
            $table->enum('estado', ['confirmada', 'cancelada'])->default('confirmada');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};