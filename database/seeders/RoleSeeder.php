<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory(2)
        ->state(new Sequence(
            ['name' => 'admin', "description" =>"admin user"],
            ['name' => 'lab admin', "description" =>"lab admin user"],
        ))
        ->create();
    }
}
