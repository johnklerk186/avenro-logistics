<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@avenrologistics.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Avenro123#'),
                'email_notifications' => true,
                'shipment_updates' => true,
                'new_orders' => true,
                'timezone' => 'UTC',
            ]
        );
    }
}