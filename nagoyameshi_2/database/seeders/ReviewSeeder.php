<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [];

        for ($i = 1; $i <= 50; $i++) {
            $reviews[] = [
                'content' => "これはテストレビュー{$i}です。料理や雰囲気についての感想が書かれています。",
                'store_id' => rand(66, 87),
                'user_id' => rand(20, 25),
                'score' => rand(1, 5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('reviews')->insert($reviews);

    }
}
