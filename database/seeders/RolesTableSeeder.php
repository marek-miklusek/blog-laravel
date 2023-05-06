<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => 1,
            'name' => 'admin',
            'description' => 'can do anything'
        ]);

        Role::create([
            'id' => 2,
            'name' => 'moderator',
            'description' => 'can do slightly less things'
        ]);

        Role::create([
            'id' => 3,
            'name' => 'user',
            'description' => 'can do nothing'
        ]);
    }
}
