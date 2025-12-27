<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            // On valide le champ 'nom_affichage' du formulaire (qui sera le nom d'affichage)
            'nom_affichage' => ['required', 'string', 'max:255'],

            // Validation du username (unique, pas d'espaces bizarres)
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        // Création avec les champs de notre base de données custom
        return User::create([
            'nom_affichage' => $input['nom_affichage'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => 'citoyen', // Rôle par défaut
            'langue_preferee' => 'fr', // Langue par défaut
        ]);
    }
}