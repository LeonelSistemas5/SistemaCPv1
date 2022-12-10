<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->char('dni',8)->unique();
            $table->string('nombres',191);
            $table->string('a_paterno',191);
            $table->string('a_materno',191);
            $table->string('direccion',191)->nullable();
            $table->char('celular',9)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
