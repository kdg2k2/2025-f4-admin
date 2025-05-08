<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'name' => 'Miễn phí',
            'download_document_limit' => 3,
            'price' => 0,
            'duration_days' => 0,
        ]);
    }
}
