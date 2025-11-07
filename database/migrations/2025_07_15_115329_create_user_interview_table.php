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
        Schema::create('user_interview', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')
                    ->constrained('resumes')
                    ->onDelete('no action');  // Changed from cascade
                
                $table->foreignId('interview_id')
                    ->constrained('interviews')
                    ->onDelete('no action');  // Changed from cascade
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interview');
    }
};
