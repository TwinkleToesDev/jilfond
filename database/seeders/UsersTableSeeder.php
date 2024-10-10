<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    private int $usersCount = 5000;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count($this->usersCount)->create();
    }
}
