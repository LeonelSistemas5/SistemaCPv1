<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('colegiados', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',6)->unique();
            $table->char('dni',8);
            $table->string('nombres',191);
            $table->string('a_paterno',191);
            $table->string('a_materno',191);
            $table->string('direccion',191)->nullable();
            $table->char('celular',9)->nullable();
            $table->unsignedBigInteger('capitulo_id')->nullable();
            $table->foreign('capitulo_id')->references('id')->on('capitulos')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colegiados');
    }
};
