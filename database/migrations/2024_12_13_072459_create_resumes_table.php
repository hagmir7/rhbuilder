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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name')->virtualAs('concat(first_name, \' \', last_name)');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->integer('marital_status')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('gender');
            $table->string('cin', 30)->nullable();
            $table->text('address')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('status')->default(1);
            $table->string('cv_file')->nullable();
            $table->string('cover_letter_file')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('company_work_post_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('experience_monthe')->nullable();
            $table->string('nationality')->default("Marocaine");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
