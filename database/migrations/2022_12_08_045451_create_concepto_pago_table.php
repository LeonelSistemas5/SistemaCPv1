<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('concepto_pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('concepto_id');
            $table->unsignedBigInteger('pago_id');
            $table->integer('cantidad');
            $table->decimal('precio',2,2);
            $table->foreign('concepto_id')->references('id')->on('conceptos')->onDelete('cascade');
            $table->foreign('pago_id')->references('id')->on('pagos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('concepto_pago');
    }
};
