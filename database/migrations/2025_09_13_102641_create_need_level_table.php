<?php

use App\Models\Level;
use App\Models\Need;
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
        Schema::create('need_level', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Need::class);
            $table->foreignIdFor(Level::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('need_level');
    }
};
