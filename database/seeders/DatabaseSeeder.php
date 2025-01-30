<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\TaskFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $chunkSize = 10000; // Number of tasks per chunk
        $totalTasksPerUser = 1000000; // Total tasks per user
        $users = User::factory(5)->create(); // Create 5 users

        foreach ($users as $user) {
            $chunks = (int) ceil($totalTasksPerUser / $chunkSize);

            for ($i = 0; $i < $chunks; $i++) {
                TaskFactory::new()->count($chunkSize)->create([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
