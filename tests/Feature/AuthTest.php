<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_register()
    {
        $response = $this->post('/api/auth/register', [
            'name' => Str::random(12),
            'email' => 'seller@gmail.com',
            'password' => '12121212'
        ]);

        $response->assertStatus(200);
    }

    public function test_login_admin()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'admin@admin.com',
            'password' => '12121212'
        ]);

        $response->assertStatus(200);
    }

    public function test_login_user()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'seller@gmail.com',
            'password' => '12121212'
        ]);

        $response->assertStatus(200);
    }
}
