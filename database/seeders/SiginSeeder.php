<?php

namespace Database\Seeders;

use App\Models\Sigin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Sigin::factory(30)->create();
    }
}
