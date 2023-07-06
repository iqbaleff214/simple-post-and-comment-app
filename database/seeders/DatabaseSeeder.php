<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'M Iqbal Effendi',
            'email' => 'iqbaleff214@gmail.com',
            'role' => 'admin',
        ]);

        Tag::factory(15)->create();

        \App\Models\User::factory(5)
            ->has(\App\Models\Post::factory()->count(10))
            ->create();
    }
}
