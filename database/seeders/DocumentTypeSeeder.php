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
                "field_id" => 1,,
                "slug" => "khac",
            ],

            // Văn bản
            [
                "id" => 2,
                "name" => "Tiêu chuẩn Việt Nam",
                "field_id" => 3,
                "slug" => "tieu-chuan-viet-nam",
            ],
            [
                "id" => 3,
                "name" => "Quyền Tác Giả",
                "field_id" => 2,
                "slug"=> "quyen-tac-gia",
            ],
            [
                "id" => 4,
                "name" => "Chứng Nhận",
                "field_id" => 2,
                "slug"=> "chung-nhan",
            ],
            [
                "id" => 5,
                "name" => "Hồ Sơ Năng Lực",
                "field_id" => 2,
                "slug"=> "ho-so-nang-luc",
            ],
            [
                "id" => 6,
                "name" => "Rừng Ven Biển",
                "field_id" => 2,
                "slug"=> "rung-ven-bien",
            ],
            [
                "id" => 7,
                "name" => "Đề Án Dlst",
                "field_id" => 2,
                "slug"=> "de-an-dlst",
            ],
            [
                "id" => 8,
                "name" => "Tài Liệu Tham Khảo",
                "field_id" => 2,
                "slug"=> "tai-lieu-tham-khao",
            ],
            [
                "id" => 9,
                "name" => "Đề Tài/Dự Án/Nhiệm Vụ",
                "field_id" => 2,
                "slug"=> "de-tai-du-an-nhiem-vu",
            ],
            [
                "id" => 10,
                "name" => "Bài Giảng",
                "field_id" => 2,
                "slug"=> "bai-giang",
            ],
            [
                "id" => 11,
                "name" => "Sổ Tay/Tài Liệu Hướng Dẫn",
                "field_id" => 2,
                "slug"=> "so-tay-tai-lieu-huong-dan",
            ],
            [
                "id" => 12,
                "name" => "Công Văn/Văn Bản",
                "field_id" => 2,
                "slug"=> "cong-van-van-ban",
            ],

            // Pháp lý
            [
                "id" => 13,
                "name" => "Hiến pháp",
                "field_id" => 3,
                "slug"=> "hien-phap",
            ],
            [
                "id" => 14,
                "name" => "Luật",
                "field_id" => 3,
                "slug"=> "luat",
            ],
            [
                "id" => 15,
                "name" => "Nghị quyết",
                "field_id" => 3,
                "slug"=> "nghi-quyet",
            ],
            [
                "id" => 16,
                "name" => "Pháp lệnh",
                "field_id" => 3,
                "slug" => "phap-lenh",
            ],
            [
                "id" => 17,
                "name" => "Nghị định",
                "field_id" => 3,
                "slug" => "nghi-dinh",
            ],
            [
                "id" => 18,
                "name" => "Thông tư",
                "field_id" => 3,
                "slug" => "thong-tu",
            ],
            [
                "id" => 19,
                "name" => "Quyết định",
                "field_id" => 3,
                "slug" => "quyet-dinh",
            ],
            [
                "id" => 20,
                "name" => "Thông tư liên tịch",
                "field_id" => 3,
                "slug" => "thong-tu-lien-tich",
            ],
            [
                "id" => 21,
                "name" => "Nghị quyết HĐND tỉnh",
                "field_id" => 3,
                "slug" => "nghi-quyet-hdnd-tinh",
            ],
            [
                "id" => 22,
                "name" => "Quyết định UBND tỉnh",
                "field_id" => 3,
                "slug" => "quyet-dinh-ubnd-tinh",
            ],
            [
                "id" => 23,
                "name" => "Công văn",
                "field_id" => 3,
                "slug" => "cong-van",
            ],
            [
                "id" => 24,
                "name" => "Văn bản",
                "field_id" => 3,
                "slug" => "van-ban",
            ],

            // Ấn phẩm khoa học
            [
                "id" => 25,
                "name" => "Hồ sơ năng lực",
                "field_id" => 4,
                "slug" => "ho-so-nang-luc",
            ],
            [
                "id" => 26,
                "name" => "Bài báo",
                "field_id" => 4,
                "slug" => "bai-bao",
            ],
            [
                "id" => 27,
                "name" => "Sách tham khảo",
                "field_id" => 4,
                "slug" => "sach-tham-khao",
            ],
            [
                "id" => 28,
                "name" => "Giáo trình",
                "field_id" => 4,
                "slug" => "giao-trinh",
            ],
            [
                "id" => 29,
                "name" => "Kỷ yếu",
                "field_id" => 4,
                "slug" => "ky-yeu",
            ],
            [
                "id" => 30,
                "name" => "Sổ tay",
                "field_id" => 4,
                "slug" => "so-tay",
            ],
            [
                "id" => 31,
                "name" => "Bài trình bày hội thảo",
                "field_id" => 4,
                "slug" => "bai-trinh-bay-hoi-thao",
            ],
            [
                "id" => 32,
                "name" => "Thư viện số",
                "field_id" => 4,
                "slug" => "thu-vien-so",
            ],

            // Đa dạng sinh học
            [
                "id" => 33,
                "name" => "Động vật",
                "field_id" => 5,
                "slug" => "dong-vat",
            ],
            [
                "id" => 34,
                "name" => "Thực vật",
                "field_id" => 5,
                "slug" => "thuc-vat",
            ],
            [
                "id" => 35,
                "name" => "Động vật & thực vật",
                "field_id" => 5,
                "slug" => "dong-vat-thuc-vat",
            ],
        ];

        DocumentType::truncate();
        DocumentType::insert($arr);
    }
}
