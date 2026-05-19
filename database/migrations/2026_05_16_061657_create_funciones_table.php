<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelicula_id')->constrained('peliculas')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('sala'); // 1,2,3
            $table->decimal('precio', 8, 2);
            $table->integer('asientos_totales')->default(50);
            $table->integer('asientos_disponibles')->default(50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funciones');
    }
};