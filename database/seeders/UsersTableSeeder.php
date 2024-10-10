<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        for ($i = 1; $i <= 2000; $i++) {
            $users[] = [
                'username' => 'user' . $i,
                'name' => 'User ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Вставка данных в таблицу
        DB::table('users')->insert($users);
    }
}
