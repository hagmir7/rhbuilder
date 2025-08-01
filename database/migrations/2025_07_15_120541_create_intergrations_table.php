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
        Schema::create('intergrations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('resume_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->date('evaluation');
            $table->foreignId('responsible_id')->nullable()->constrained('users')->nullOnDelete();
            $table->float('period')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intergrations');
    }
};
