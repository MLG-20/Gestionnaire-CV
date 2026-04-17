<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            if (!Schema::hasColumn('experiences', 'profile_id')) {
                $table->foreignId('profile_id')->nullable()->constrained('profiles')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeignIdFor('profiles', 'profile_id');
            $table->dropColumn('profile_id');
        });
    }
};
