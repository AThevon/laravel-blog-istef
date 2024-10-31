<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rôle par défaut pour les utilisateurs
        $reader = Role::where('name', 'reader')->first();
        $author = Role::where('name', 'author')->first();

        // Création manuelle avec un rôle spécifique
        User::create([
            'name' => 'athevon',
            'email' => 'athevon@gmail.com',
            'password' => Hash::make('admin123'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        User::create([
            'name' => 'reader',
            'email' => 'reader@gmail.com',
            'password' => Hash::make('reader123'),
            'role_id' => $reader->id,
        ]);

        User::create([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('author123'),
            'role_id' => $author->id,
        ]);

        User::factory(10)->create(['role_id' => $author->id]);
        User::factory(10)->create(['role_id' => $reader->id]);
    }
}
