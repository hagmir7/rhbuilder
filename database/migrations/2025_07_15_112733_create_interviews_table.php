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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('responsable_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor('resume_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor('post_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor('template_id')->nullable()->constrained()->nullOnDelete();
            $table->dateTime('date')->nullable();
            $table->integer('type');
            $table->foreignIdFor('company_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('decision')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
