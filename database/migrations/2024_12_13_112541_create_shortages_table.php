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
        Schema::create('shortages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_post_id')->constrained()->onDelete('cascade');
            $table->integer('number')->default(1);
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
            $table->integer("min_experience")->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('level_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shortages');
    }
};
