<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::query()->create([
            'name' => 'khaicao',
            'email' => 'khaicao@gmail.com',
            'password' => Hash::make(12345678),
            'avatar' => fake()->imageUrl(),
        ]);
       $post =  Post::query()->create([
            'title' => fake()->name(),
            'image' => fake()->imageUrl(),
            'content' => fake()->text(),
        ]);

        $user->posts()->sync($post->id);
    }
}
