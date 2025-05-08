<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(AdminSeeder::class);
        // $this->call(PaymentSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(DocumentFieldSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(DocumentSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
