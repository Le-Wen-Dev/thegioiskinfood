<?php
namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Categories::create([
                'name' => $this->generateRandomString(),
                'stt' => rand(0, 1), // Đặt độ dài của chuỗi mô tả ở đây
                'home' => rand(0, 1), // Tạo một số ngẫu nhiên để xác định trạng thái
            ]);
        }
    }
    
    private function generateRandomString(): string
    {
        // Implement your logic to generate a random string here
        return 'Random Category Name';
    }
}
