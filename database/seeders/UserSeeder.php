<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory()
           ->create(
             [
                 'role_id' => Role::whereName('admin')->first()->id,
                 'name' => 'code jr',
                 'email' => 'codejr@gmail.com',
                 'phone' => '0123456789',
                 'password' =>'super'
             ]
           );
    }
}
