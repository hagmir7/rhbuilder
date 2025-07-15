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
        Schema::create('needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('responsable_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('diplome_id')->constrained()->onDelete('cascade');
            $table->integer('experience_min')->default(0);
            $table->integer('gender')->nullable(); // 0 = homme, 1 = femme, 2 = indifférent par ex.
            $table->integer('min_age')->default(20);
            $table->integer('max_age')->default(30);
            $table->integer('status')->default(1); // ex: 1 = actif, 0 = inactif
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('needs');
    }
};
