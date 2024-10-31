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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idrol');
            $table->unsignedBigInteger('idmodulo');
            $table->boolean('r')->default(0);
            $table->boolean('w')->default(0);
            $table->boolean('u')->default(0);
            $table->boolean('d')->default(0);
            $table->timestamps();

            $table->foreign('idrol')
                ->references('id')
                ->on('rol')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('idmodulo')
                ->references('id')
                ->on('modulo')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
