<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
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
                "field_id" => 1,
            ],

            // Văn bản
            [
                "id" => 2,
                "name" => "Tiêu chuẩn Việt Nam",
                "field_id" => 3,
            ],
            [
                "id" => 3,
                "name" => "Quyền Tác Giả",
                "field_id" => 2,
            ],
            [
                "id" => 4,
                "name" => "Chứng Nhận",
                "field_id" => 2,
            ],
            [
                "id" => 5,
                "name" => "Hồ Sơ Năng Lực",
                "field_id" => 2,
            ],
            [
                "id" => 6,
                "name" => "Rừng Ven Biển",
                "field_id" => 2,
            ],
            [
                "id" => 7,
                "name" => "Đề Án Dlst",
                "field_id" => 2,
            ],
            [
                "id" => 8,
                "name" => "Tài Liệu Tham Khảo",
                "field_id" => 2,
            ],
            [
                "id" => 9,
                "name" => "Đề Tài/Dự Án/Nhiệm Vụ",
                "field_id" => 2,
            ],
            [
                "id" => 10,
                "name" => "Bài Giảng",
                "field_id" => 2,
            ],
            [
                "id" => 11,
                "name" => "Sổ Tay/Tài Liệu Hướng Dẫn",
                "field_id" => 2,
            ],
            [
                "id" => 12,
                "name" => "Công Văn/Văn Bản",
                "field_id" => 2,
            ],

            // Pháp lý
            [
                "id" => 13,
                "name" => "Hiến pháp",
                "field_id" => 3,
            ],
            [
                "id" => 14,
                "name" => "Luật",
                "field_id" => 3,
            ],
            [
                "id" => 15,
                "name" => "Nghị quyết",
                "field_id" => 3,
            ],
            [
                "id" => 16,
                "name" => "Pháp lệnh",
                "field_id" => 3,
            ],
            [
                "id" => 17,
                "name" => "Nghị định",
                "field_id" => 3,
            ],
            [
                "id" => 18,
                "name" => "Thông tư",
                "field_id" => 3,
            ],
            [
                "id" => 19,
                "name" => "Quyết định",
                "field_id" => 3,
            ],
            [
                "id" => 20,
                "name" => "Thông tư liên tịch",
                "field_id" => 3,
            ],
            [
                "id" => 21,
                "name" => "Nghị quyết HĐND tỉnh",
                "field_id" => 3,
            ],
            [
                "id" => 22,
                "name" => "Quyết định UBND tỉnh",
                "field_id" => 3,
            ],
            [
                "id" => 23,
                "name" => "Công văn",
                "field_id" => 3,
            ],
            [
                "id" => 24,
                "name" => "Văn bản",
                "field_id" => 3,
            ],

            // Ấn phẩm khoa học
            [
                "id" => 25,
                "name" => "Hồ sơ năng lực",
                "field_id" => 4,
            ],
            [
                "id" => 26,
                "name" => "Bài báo",
                "field_id" => 4,
            ],
            [
                "id" => 27,
                "name" => "Sách tham khảo",
                "field_id" => 4,
            ],
            [
                "id" => 28,
                "name" => "Giáo trình",
                "field_id" => 4,
            ],
            [
                "id" => 29,
                "name" => "Kỷ yếu",
                "field_id" => 4,
            ],
            [
                "id" => 30,
                "name" => "Sổ tay",
                "field_id" => 4,
            ],
            [
                "id" => 31,
                "name" => "Bài trình bày hội thảo",
                "field_id" => 4,
            ],
            [
                "id" => 32,
                "name" => "Thư viện số",
                "field_id" => 4,
            ],

            // Đa dạng sinh học
            [
                "id" => 33,
                "name" => "Động vật",
                "field_id" => 5,
            ],
            [
                "id" => 34,
                "name" => "Thực vật",
                "field_id" => 5,
            ],
            [
                "id" => 35,
                "name" => "Động vật & thực vật",
                "field_id" => 5,
            ],
        ];

        DocumentType::truncate();
        DocumentType::insert($arr);
    }
}
