<?php

namespace Database\Seeders;

use App\Models\Broker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Broker::create([
            'name'=>'Admin',
            'email'=>'broker@app.com',
            'password'=>Hash::make('12345'),
        ]);
    }
}
