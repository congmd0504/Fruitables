<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Tạo role
        DB::table('roles')->insert([
            ['role' => 'admin'],
            ['role' => 'Nhân viên'],
            ['role' => 'user'],
        ]);
        //Tạo acc
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'email' => 'admin@gmail.com',
            'role_id' => 1,
        ]);
        //Tạo status order
        DB::table('status_orders')->insert([
            ['name' => 'Chờ xác nhận'],
            ['name' => 'Đã xác nhận'],
            ['name' => 'Đang xử lý'],
            ['name' => 'Đang vận chuyển'],
            ['name' => 'Giao thành công'],
            ['name' => 'Đã hủy'],
            ['name' => 'Chờ thanh toán'],
            ['name' => 'Đã thanh toán'],
        ]);
    }
}
