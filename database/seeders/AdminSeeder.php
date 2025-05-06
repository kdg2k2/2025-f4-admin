<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        Admin::create([
            'name' => config('app.name'),
            'email' => config('mail.from.address'),
            'password' => bcrypt(config('app.default-password')),
            'path' => null,
        ]);
    }
}
