<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gastos_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idgasto');
            $table->string('detalle');
            $table->integer('cantidad');
            $table->double('precio');
            $table->foreign('idgasto')
                ->references('id')
                ->on('gastos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_detalles');
    }
};
