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

            $table->foreignId('service_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('responsable_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('diploma_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('experience_min')->default(0);
            $table->unsignedTinyInteger('gender')->nullable(); // 0: Homme, 1: Femme, etc.
            $table->unsignedTinyInteger('min_age')->default(20);
            $table->unsignedTinyInteger('max_age')->default(30);
            $table->unsignedTinyInteger('status')->default(1); // 1: actif, 0: inactif...

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
