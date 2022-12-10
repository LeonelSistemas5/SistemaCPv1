<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('colegios', function (Blueprint $table) {
            $table->id();
            $table->char('ruc',11)->unique();
            $table->string('razon_social',191);
            $table->string('email',191)->unique()->nullable();
            $table->string('logo',191)->nullable();
            $table->string('logo_dark',191)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colegios');
    }
};
