<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('derivaciones', function (Blueprint $table) {
            $table->id();
            $table->dateTime('hora');
            $table->unsignedBigInteger('tramite_id');
            $table->unsignedBigInteger('oficina_origen');
            $table->unsignedBigInteger('oficina_destino');
            $table->foreign('tramite_id')->references('id')->on('tramites')->onDelete('cascade');
            $table->foreign('oficina_origen')->references('id')->on('oficinas')->onDelete('cascade');
            $table->foreign('oficina_destino')->references('id')->on('oficinas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('derivaciones');
    }
};
