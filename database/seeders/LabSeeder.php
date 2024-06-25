<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('labs')->insert([
           "name" => "Medaten Laboratory",
           "slug"=> "medaten-lab",
           "address" => "No34, Rukpoku str, PortHarcout, Nigeria",
           "phone"=> "09803282822",
           "email" => "medatenlab@gmail.com",
           "approved" => 1,
           "status" => 1,
           "description" => "Medaten laboratory and Pharmaceutical services",
       ]);

//       Laboratory::first()->users()->attach(1);
    }}
