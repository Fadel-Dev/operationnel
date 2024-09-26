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
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->string('nom');
            $table->string('periode');
            $table->string('format');
            $table->unsignedBigInteger('trackerId')->nullable(false);



              $table->unsignedBigInteger('groupeId');
            $table->unsignedBigInteger('moduleId');
            $table->unsignedBigInteger('tuteurId')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
