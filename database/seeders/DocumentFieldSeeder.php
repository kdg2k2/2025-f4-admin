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
                "name" => "Khác",
                "slug" => "khac",
                "bg_class" => "bg-secondary-transparent",
                "tx_class" => "tx-secondary",
                "icon_class" => "fa-solid fa-file",
            ],
            [
                "id" => 2,
                "name" => "Văn bản",
                "slug" => "van-ban",
                "bg_class" => "bg-primary-transparent",
                "tx_class" => "tx-primary",
                "icon_class" => "fa-solid fa-file",
            ],
            [
                "id" => 3,
                "name" => "Văn bản pháp luật",
                "slug" => "van-ban-phap-luat",
                "bg_class" => "bg-success-transparent",
                "tx_class" => "tx-success",
                "icon_class" => "fa-solid fa-file",
            ],
            [
                "id" => 4,
                "name" => "Ấn phẩm khoa học",
                "slug" => "an-pham-khoa-hoc",
                "bg_class" => "bg-purple-transparent",
                "tx_class" => "tx-purple",
                "icon_class" => "fa-solid fa-file",
            ],
            [
                "id" => 5,
                "name" => "Đa dạng sinh học",
                "slug" => "da-dang-sinh-hoc",
                "bg_class" => "bg-info-transparent",
                "tx_class" => "tx-info",
                "icon_class" => "fa-solid fa-file",
            ],
        ];
        DocumentField::truncate();
        DocumentField::insert($arr);
    }
}
