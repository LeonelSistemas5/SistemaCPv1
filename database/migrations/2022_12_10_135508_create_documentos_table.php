<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('documento',191);
            $table->unsignedBigInteger('tramite_id')->nullable();
            $table->unsignedBigInteger('intento_id')->nullable();
            $table->foreign('tramite_id')->references('id')->on('tramites')->onDelete('set null');
            $table->foreign('intento_id')->references('id')->on('intentos')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
};
