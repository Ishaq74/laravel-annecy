<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ÉTAPE 1 : Création de la structure de base
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Défini explicitement comme clé primaire

            // Architecture de l'Arbre (Colonnes techniques pour Nested Sets)
            $table->uuid('parent_id')->nullable()->index();
            $table->unsignedInteger('_lft')->default(0)->index();
            $table->unsignedInteger('_rgt')->default(0)->index();

            // Identification Métier
            $table->string('type')->index(); // infrastructure, gastronomy, activities, etc.
            $table->string('internal_code')->unique()->index();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order_priority')->default(0);

            // Données Multilingues (JSONB PostgreSQL)
            $table->jsonb('name');
            $table->jsonb('slug');
            $table->jsonb('description')->nullable();

            // Infrastructure SEO / OpenGraph / A11y
            $table->jsonb('seo_title')->nullable();
            $table->jsonb('seo_meta_description')->nullable();
            $table->jsonb('og_title')->nullable();
            $table->jsonb('og_description')->nullable();
            $table->jsonb('featured_image_alt')->nullable();

            // UI & Sémantique
            $table->string('icon_name')->nullable();
            $table->string('color_theme', 7)->nullable();
            $table->string('schema_type')->default('CollectionPage');

            $table->timestamps();
            $table->softDeletes();
        });

        // ÉTAPE 2 : Ajout de la contrainte étrangère (Après la création de la table)
        // Cela garantit que l'ID est bien indexé avant de créer le lien.
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });

    // Index GIN uniquement pour PostgreSQL
    if (DB::getDriverName() === 'pgsql') {
        DB::statement('CREATE INDEX categories_name_gin ON categories USING gin (name)');
        DB::statement('CREATE INDEX categories_slug_gin ON categories USING gin (slug)');
    }
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
