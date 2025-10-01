<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names = [
            '和食', '洋食', '中華料理', '韓国料理', 'イタリアン', 'フレンチ', 'インド料理', 'タイ料理',
            'ベトナム料理', 'スペイン料理', 'メキシコ料理', 'ラーメン', 'そば・うどん', '焼肉', '寿司',
            'カレー', '居酒屋', 'カフェ', 'ビュッフェ・バイキング', '海鮮', '焼き鳥',
        ];

        foreach ($category_names as $category_name) {
            Category::create(['category_name' => $category_name]);
        }
    }
}
