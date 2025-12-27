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
        Schema::create('users', function (Blueprint $table) {
            // PRD: Clé primaire UUID
            $table->uuid('id')->primary();
            
            // PRD: Identifiants
            $table->string('id_authentification')->nullable()->unique()->index(); // Pour OAuth
            $table->string('username')->unique(); // "ville_num_user"
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // Nullable car OAuth possible
            
            // PRD: Profil Public
            $table->string('nom_affichage'); // "Jean Dupond"
            $table->text('bio')->nullable();
            $table->string('avatar_url')->nullable();
            
            // PRD: Préférences & Rôles
            $table->string('role')->default('citoyen'); // citoyen, admin, auteur...
            $table->string('langue_preferee')->default('fr');
            
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // PRD: Suppression douce
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};