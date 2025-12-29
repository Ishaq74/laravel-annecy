<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        // 1. TAXONOMIE DES ÉQUIPEMENTS (Groupes)
        Schema::create('amenity_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('internal_code')->unique(); // GRP_SKI, GRP_LUXURY
            $table->jsonb('name');
            $table->integer('position')->default(0);
            $table->string('ui_style')->default('list'); // badges, icons, list
            $table->timestamps();
        });

        // 2. ÉQUIPEMENTS ATOMIQUES (Services)
        Schema::create('amenities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('group_id')->constrained('amenity_groups')->cascadeOnDelete();
            $table->string('internal_code')->unique();
            $table->jsonb('name');
            $table->string('icon_provider')->default('heroicon');
            $table->string('icon_name')->nullable();
            $table->jsonb('applicable_contexts'); // ["trail", "hotel", "global"]
            $table->timestamps();
        });

        // 3. LE LIEU (Place) - INFRASTRUCTURE CORE
        Schema::create('places', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Classification
            $table->foreignUuid('owner_id')->constrained('users');
            $table->foreignUuid('category_id')->constrained('categories');

            // Workflow & Qualité
            $table->string('status')->default('pending')->index();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('quality_score')->default(0);

            // SIG (Géolocalisation Haute Précision)
            $table->decimal('latitude', 10, 8)->index();
            $table->decimal('longitude', 11, 8)->index();
            $table->decimal('elevation', 6, 2)->nullable();
            $table->string('address_full');
            $table->string('city_name')->index();
            $table->string('postal_code')->index();
            $table->string('country_code', 2)->default('FR');

            // Identité (Multilingue)
            $table->jsonb('name');
            $table->jsonb('slug');
            $table->jsonb('description');
            $table->jsonb('short_description')->nullable();

            // Contact
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->jsonb('socials')->nullable();

            // SEO & Exploitation
            $table->jsonb('seo_data')->nullable();
            $table->jsonb('opening_hours')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        // 4. LIAISON PIVOT (Lieux <-> Équipements)
        Schema::create('amenity_place', function (Blueprint $table) {
            $table->foreignUuid('place_id')->constrained('places')->cascadeOnDelete();
            $table->foreignUuid('amenity_id')->constrained('amenities')->cascadeOnDelete();
            $table->string('meta_value')->nullable();
            $table->primary(['place_id', 'amenity_id']);
        });

        // --- EXTENSIONS MÉTIERS (POLYMORPHISME VERTICAL) ---

        // 5. RESTAURATION
        Schema::create('place_gastronomies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('place_id')->unique()->constrained('places')->cascadeOnDelete();
            $table->jsonb('cuisine_types');
            $table->jsonb('dietary_types')->nullable();
            $table->integer('price_level')->default(2);
            $table->decimal('avg_price_dish', 6, 2)->nullable();
            $table->integer('michelin_stars')->default(0);
            $table->string('chef_name')->nullable();
            $table->timestamps();
        });

        // 6. HÉBERGEMENT
        Schema::create('place_accommodations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('place_id')->unique()->constrained('places')->cascadeOnDelete();
            $table->string('type')->index(); // hotel, camping, refuge
            $table->integer('star_rating')->nullable();
            $table->integer('total_units')->nullable();
            $table->integer('total_beds')->nullable(); // Pour dortoirs/refuges
            $table->time('check_in')->default('15:00');
            $table->time('check_out')->default('11:00');
            $table->timestamps();
        });

        // 7. TRAILS (Outdoor / Sport)
        Schema::create('place_trails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('place_id')->unique()->constrained('places')->cascadeOnDelete();
            $table->string('activity_type')->index();
            $table->string('difficulty')->index();
            $table->decimal('distance_km', 6, 2);
            $table->integer('elevation_gain')->nullable();
            $table->integer('elevation_loss')->nullable();
            $table->integer('max_altitude')->nullable();
            $table->boolean('is_loop')->default(true);
            $table->date('season_start')->nullable();
            $table->date('season_end')->nullable();
            $table->timestamps();
        });

        // 8. COMMERCE (Shops)
        Schema::create('place_shops', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('place_id')->unique()->constrained('places')->cascadeOnDelete();
            $table->string('shop_type')->index(); // fashion, artisan, food
            $table->jsonb('brands')->nullable();
            $table->boolean('is_artisan')->default(false);
            $table->timestamps();
        });

        // 9. CULTURE & SALLES (Venues)
        Schema::create('place_venues', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('place_id')->unique()->constrained('places')->cascadeOnDelete();
            $table->string('venue_type')->index();
            $table->integer('capacity')->nullable();
            $table->boolean('indoor')->default(true);
            $table->timestamps();
        });

        // Indexation GIN (Performance Recherche) — Postgres only
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('CREATE INDEX places_name_gin ON places USING gin (name)');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('place_venues');
        Schema::dropIfExists('place_shops');
        Schema::dropIfExists('place_trails');
        Schema::dropIfExists('place_accommodations');
        Schema::dropIfExists('place_gastronomies');
        Schema::dropIfExists('amenity_place');
        Schema::dropIfExists('places');
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('amenity_groups');
    }
};
