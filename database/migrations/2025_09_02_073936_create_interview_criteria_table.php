<?php

use App\Models\Criteria;
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
        Schema::create('interview_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Criteria::class);
            $table->foreignIdFor(Interview::class);
            $table->integer('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_criteria');
    }
};
