<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Ajouter les indexes de performance
     */
    public function up(): void
    {
        // Index sur users table
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Index simple pour email (login)
                if (!$this->indexExists('users', 'users_email_index')) {
                    $table->index('email');
                }
                // Index pour filtrage admin
                if (!$this->indexExists('users', 'users_is_admin_index')) {
                    $table->index('is_admin');
                }
                // Index pour statistiques
                if (!$this->indexExists('users', 'users_created_at_index')) {
                    $table->index('created_at');
                }
            });
        }

        // Index sur profiles table
        if (Schema::hasTable('profiles')) {
            Schema::table('profiles', function (Blueprint $table) {
                if (!$this->indexExists('profiles', 'profiles_user_id_index')) {
                    $table->index('user_id');
                }
                if (!$this->indexExists('profiles', 'profiles_created_at_index')) {
                    $table->index('created_at');
                }
            });
        }

        // Index sur experiences table
        if (Schema::hasTable('experiences')) {
            Schema::table('experiences', function (Blueprint $table) {
                if (!$this->indexExists('experiences', 'experiences_user_id_index')) {
                    $table->index('user_id');
                }
                if (!$this->indexExists('experiences', 'experiences_created_at_index')) {
                    $table->index('created_at');
                }
                if (!$this->indexExists('experiences', 'experiences_user_id_created_at_index')) {
                    $table->index(['user_id', 'created_at']);
                }
            });
        }

        // Index sur educations table
        if (Schema::hasTable('educations')) {
            Schema::table('educations', function (Blueprint $table) {
                if (!$this->indexExists('educations', 'educations_user_id_index')) {
                    $table->index('user_id');
                }
                if (!$this->indexExists('educations', 'educations_created_at_index')) {
                    $table->index('created_at');
                }
            });
        }

        // Index sur skills table
        if (Schema::hasTable('skills')) {
            Schema::table('skills', function (Blueprint $table) {
                if (!$this->indexExists('skills', 'skills_user_id_index')) {
                    $table->index('user_id');
                }
                if (!$this->indexExists('skills', 'skills_level_index')) {
                    $table->index('level');
                }
            });
        }

        // Index sur hobbies table
        if (Schema::hasTable('hobbies')) {
            Schema::table('hobbies', function (Blueprint $table) {
                if (!$this->indexExists('hobbies', 'hobbies_user_id_index')) {
                    $table->index('user_id');
                }
            });
        }

        // Index sur cv_settings table
        if (Schema::hasTable('cv_settings')) {
            Schema::table('cv_settings', function (Blueprint $table) {
                if (!$this->indexExists('cv_settings', 'cv_settings_user_id_unique')) {
                    $table->unique('user_id');
                }
            });
        }

        // Index sur cache table
        if (Schema::hasTable('cache')) {
            Schema::table('cache', function (Blueprint $table) {
                if (!$this->indexExists('cache', 'cache_expiration_index')) {
                    $table->index('expiration');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Les indexes seront automatiquement supprimés lors du drop table
        // Mais si besoin de les supprimer manuellement:
        
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropIndex('users_email_index');
                $table->dropIndex('users_is_admin_index');
                $table->dropIndex('users_created_at_index');
            });
        }

        if (Schema::hasTable('profiles')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->dropIndex('profiles_user_id_index');
                $table->dropIndex('profiles_created_at_index');
            });
        }

        if (Schema::hasTable('experiences')) {
            Schema::table('experiences', function (Blueprint $table) {
                $table->dropIndex('experiences_user_id_index');
                $table->dropIndex('experiences_created_at_index');
                $table->dropIndex('experiences_user_id_created_at_index');
            });
        }

        if (Schema::hasTable('educations')) {
            Schema::table('educations', function (Blueprint $table) {
                $table->dropIndex('educations_user_id_index');
                $table->dropIndex('educations_created_at_index');
            });
        }

        if (Schema::hasTable('skills')) {
            Schema::table('skills', function (Blueprint $table) {
                $table->dropIndex('skills_user_id_index');
                $table->dropIndex('skills_level_index');
            });
        }

        if (Schema::hasTable('hobbies')) {
            Schema::table('hobbies', function (Blueprint $table) {
                $table->dropIndex('hobbies_user_id_index');
            });
        }

        if (Schema::hasTable('cv_settings')) {
            Schema::table('cv_settings', function (Blueprint $table) {
                $table->dropUnique('cv_settings_user_id_unique');
            });
        }

        if (Schema::hasTable('cache')) {
            Schema::table('cache', function (Blueprint $table) {
                $table->dropIndex('cache_expiration_index');
            });
        }
    }

    /**
     * Vérifier si un index existe
     */
    private function indexExists(string $table, string $indexName): bool
    {
        $indexes = \Illuminate\Support\Facades\DB::select(
            "SELECT * FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_NAME = ? AND INDEX_NAME = ?",
            [$table, $indexName]
        );
        return !empty($indexes);
    }
};
