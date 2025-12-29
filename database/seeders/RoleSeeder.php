<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'citoyen',
            'proprietaire',
            'auteur',
            'administrateur',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin@ville-numerique.local'],
            [
                'username' => 'super_admin',
                'nom_affichage' => 'Super Administrateur',
                'password' => Hash::make('password'),
                'role' => 'administrateur',
                'langue_preferee' => 'fr',
                'bio' => 'Le gardien de la ville.',
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('administrateur');
    }
}
