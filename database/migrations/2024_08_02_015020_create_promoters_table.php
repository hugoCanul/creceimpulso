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
        Schema::create('promoters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('lastName', 50);
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('no action')->onUpdate('cascade');
            $table->foreignId('coordinator_id')->nullable()->constrained('coordinators')->onDelete('no action')->onUpdate('cascade');
            $table->string('phone', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promoters');
    }
};
