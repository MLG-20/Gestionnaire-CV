<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cv_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();
            $table->string('template_name')->default('classic');
            $table->string('primary_color')->default('#2563eb');
            $table->string('secondary_color')->default('#64748b');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cv_settings');
    }
};
