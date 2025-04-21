<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_user(){
       $this->post('admin/users', [
                'name' => 'khaicao',
                'email' => 'khaicao@gmail.com',
                'password' => Hash::make(12345678),
                'avatar' => fake()->imageUrl(),
       ]);
    }
    
}
