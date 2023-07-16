<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public function testSetUp()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        $this->assertTrue(true);
    }

    public function testRequireEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The Email field is required. (and 1 more error)',
                'errors' => [
                    'email' => ['The Email field is required.'],
                    'password' => ['The Password field is required.']
                ]
            ]);

    }

    public function testUserLoginSuccessfully()
    {
        $user = ['email' => 'test@email.com', 'password' => 'testPassword'];
        $this->json('POST', route('login'), $user)
             ->assertStatus(200)
             ->assertJsonStructure([
                'token',
                'status',
                'message'
             ]);
    }

    public function testLogoutSuccessfully()
    {
        $user = ['email' => 'test@email.com', 'password' => 'testPassword'];
        Auth::attempt($user);
        $token = Auth::user()->createToken('TEST TOKEN')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('POST', route('logout'), [], $headers)
             ->assertStatus(200);
    }

    public function testInvalidCredentials()
    {
        $user = ['email' => 'test@email.com', 'password' => 'wrongpassword'];
        $this->postJson(route('login'),$user)
             ->assertUnauthorized();
    }

}
