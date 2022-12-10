<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->unsignedBigInteger('tramitetipo_id')->nullable();
            $table->unsignedBigInteger('colegiado_id');
            $table->foreign('tramitetipo_id')->references('id')->on('tramitetipos')->onDelete('set null');
            $table->foreign('colegiado_id')->references('id')->on('colegiados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tramites');
    }
};
