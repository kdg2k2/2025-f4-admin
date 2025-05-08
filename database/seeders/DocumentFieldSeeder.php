<?php

namespace Database\Seeders;

use App\Models\DocumentField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            [
                "id" => 1,
                "name" => "Khác"
            ],
            [
                "id" => 2,
                "name" => "Văn bản"
            ],
            [
                "id" => 3,
                "name" => "Văn bản pháp luật"
            ],
            [
                "id" => 4,
                "name" => "Ấn phẩm khoa học"
            ],
            [
                "id" => 5,
                "name" => "Đa dạng sinh học"
            ],
        ];
        DocumentField::truncate();
        DocumentField::insert($arr);
    }
}
