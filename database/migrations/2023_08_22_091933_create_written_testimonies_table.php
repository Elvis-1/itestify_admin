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
        Schema::create('written_testimonies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('categories_id');
            $table->text('testimony');

            $table->foreign('users_id')->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

            $table->foreign('categories_id')->references('id')
            ->on('categories')
            ->onDelete('restrict')
            ->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('written_testimonies');
    }
};
