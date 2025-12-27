<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasUuids, HasRoles;

    /**
     * Les champs remplissables (PRD + Auth).
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_authentification',
        'username',
        'nom_affichage',
        'email',
        'password',
        'bio',
        'avatar_url',
        'role',
        'langue_preferee',
    ];

    /**
     * Les champs cachés (Sécurité Fortify + Laravel).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * Conversions de types.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Génère les initiales pour l'avatar (Requis par Flux UI).
     * Adapté pour utiliser 'nom_affichage' au lieu de 'name'.
     */
    public function initials(): string
    {
        return Str::of($this->nom_affichage)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Hack de compatibilité : Si Flux cherche 'name', on lui donne 'nom_affichage'.
     */
    public function getNameAttribute()
    {
        return $this->nom_affichage;
    }
}