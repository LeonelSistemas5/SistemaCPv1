<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('requisito_tramitetipo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisito_id');
            $table->unsignedBigInteger('tramitetipo_id');
            $table->foreign('requisito_id')->references('id')->on('requisitos')->onDelete('cascade');
            $table->foreign('tramitetipo_id')->references('id')->on('tramitetipos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requisito_tramitetipo');
    }
};
