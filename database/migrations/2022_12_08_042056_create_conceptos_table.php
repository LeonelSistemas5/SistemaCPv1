<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->id();
            $table->string('denominacion',191);
            $table->decimal('precio',6,2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conceptos');
    }
};
