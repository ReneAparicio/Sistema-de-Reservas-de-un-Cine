<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 150);
            $table->string('genero', 50);
            $table->integer('duracion'); // en minutos
            $table->string('clasificacion', 10); // ATP, +13, +18
            $table->text('sinopsis')->nullable();
            $table->string('imagen')->nullable(); // para poster
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};