<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'name' => '山田 太郎',
            'email' => 'yamada.taro@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('pass1234'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'name' => '佐藤 花子',
            'email' => 'sato.hanako@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('pass5678'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'name' => '高橋 健一',
            'email' => 'takahashi.kenichi@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('pass9012'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'name' => '中村 美咲',
            'email' => 'nakamura.misaki@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('misaki2025'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'name' => '小林 翔太',
            'email' => 'kobayashi.shota@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('shota456'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'name' => '井上 結衣',
            'email' => 'inoue.yui@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('yui789'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    ]);

    }
}
