<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('intentos', function (Blueprint $table) {
            $table->id();
            $table->decimal('nota',2,2)->nullable();
            $table->unsignedBigInteger('inscripcione_id');
            $table->unsignedBigInteger('tarea_id');
            $table->foreign('inscripcione_id')->references('id')->on('inscripciones')->onDelete('cascade');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('intentos');
    }
};
