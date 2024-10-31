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
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idclase');
            $table->char('serie',3);
            $table->string('nrodoc',15);
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->double('total');
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('idclase')
                ->references('id')
                ->on('clases')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};
