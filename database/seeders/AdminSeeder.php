<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Admin::created([
            'name'=> 'Prof',
            'email'=>'admin@app.com',
            'password'=>Hash::make(12345)
        ]);
    }
}

/*

      Admin::create([
            'name'=> 'Muhanned',
            'email'=>'mm@app.com',
            'password'=>Hash::make(54321),
        ]);
*/