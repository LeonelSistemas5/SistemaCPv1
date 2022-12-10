<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('denominacion',191);
            $table->decimal('precio_certificado',6,2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->text('temario',500)->nullable();
            $table->string('modelo_certificado',191)->nullable();
            $table->enum('estado',['0','1','2']);
            $table->unsignedBigInteger('capitulo_id');
            $table->foreign('capitulo_id')->references('id')->on('capitulos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
