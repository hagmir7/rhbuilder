<?php

use App\Models\Interview;
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
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('resume_id')->constrained()->onDelete('no action');
            $table->foreignId('post_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('evaluation_date')->nullable();
            $table->date('hire_date')->nullable();
            $table->foreignId('responsible_id')->nullable()->constrained('users')->onDelete('no action');
            $table->float('period')->default(0);
            $table->integer('status')->default(0);
            $table->foreignIdFor(Interview::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrations');
    }
};
