<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {;
        $data = [
            [
                'sub_category_id' => 0,
                'category_name' => "nam",
            ],
            [
                'sub_category_id' => 1,
                'category_name' => "ao nam",
            ],
            [
                'sub_category_id' => 0,
                'category_name' => "nu",
            ],
            [
                'sub_category_id' => 1,
                'category_name' => "quan nam",
            ]
        ];

        try {
            foreach ($data as $value) {
                Category::insert($value);
            }
        } catch (\Throwable $th) {

        }
    }
}
