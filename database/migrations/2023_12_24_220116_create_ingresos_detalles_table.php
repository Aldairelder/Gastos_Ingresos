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
        Schema::create('ingresos_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idingreso');
            $table->string('detalle');
            $table->integer('cantidad');
            $table->double('precio');
            
            $table->foreign('idingreso')
                ->references('id')
                ->on('ingresos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos_detalles');
    }
};
