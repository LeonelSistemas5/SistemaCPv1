<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('oficina_id')->nullable()->after('is_active');
            $table->unsignedBigInteger('persona_id')->unique()->nullable()->after('is_active');
            $table->unsignedBigInteger('colegiado_id')->unique()->nullable()->after('is_active');
            $table->unsignedBigInteger('sede_id')->after('is_active');
            $table->foreign('oficina_id')->references('id')->on('oficinas')->onDelete('set null');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('colegiado_id')->references('id')->on('colegiados')->onDelete('cascade');
            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_oficina_id_foreign');
            $table->dropForeign('users_persona_id_foreign');
            $table->dropForeign('users_colegiado_id_foreign');
            $table->dropForeign('users_sede_id_foreign');
            $table->dropColumn('oficina_id');
            $table->dropColumn('persona_id');
            $table->dropColumn('colegiado_id');
            $table->dropColumn('sede_id');
        });
    }
};
