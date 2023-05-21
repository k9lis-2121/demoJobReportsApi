<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Report;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrNew(['name' => 'admin', 'email' => 'admin@admin.ru', 'email_verified_at' => '2023-05-16 00:00:00', 'password' => '$2y$10$CnzZnVq/YcsbOWbRNXSAKuH9Jx7PTilKkP52Rccgr03enK1.ppNZi', 'roles' => '{"ROLE":"ADMIN"}']);
        Worker::factory(10)->create();
        Report::factory(300)->create();
    }
}
