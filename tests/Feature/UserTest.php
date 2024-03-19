<?php

namespace Tests\Feature;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create user with return 201
     * @test
     */
    public function create_user_successfully(): void
    {
        $userRequest = new UserRequest(
            [
                'fullname' => 'Luiz Augusto Neto',
                'document' => '09375156478',
                'email' => 'luiz@gmail.com',
                'password' => '123456',
                'user_type' => 'common',
            ]
        );

        $response = $this->call('POST', route('user.create'), $userRequest->toArray());

        $response->assertStatus(201);
    }

    /**
     * Update user
     * @test
     */
    public function update_user_successfully(): void
    {
        $userRequest = new UserRequest(
            [
                'fullname' => 'Luiz Augusto Neto',
                'document' => '09375156478',
                'email' => 'luiz@gmail.com',
                'password' => '123456',
                'user_type' => 'common',
            ]
        );

        $response = $this->call('POST', route('user.create'), $userRequest->toArray());

        $user = User::first();

        $userRequest = new UpdateUserRequest(
            [
                'fullname' => 'Luiz Augusto2 Neto',
                'password' => '123456',
            ]
        );

        $response = $this->call('PUT', route('user.update', ['id' => $user->id]), $userRequest->toArray());

        $response->assertStatus(200);
    }

    /**
     * Get user
     * @test
     */
    public function get_user(): void
    {
        $userRequest = new UserRequest(
            [
                'fullname' => 'Luiz Augusto Neto',
                'document' => '09375156478',
                'email' => 'luiz@gmail.com',
                'password' => '123456',
                'user_type' => 'common',
            ]
        );

        $response = $this->call('POST', route('user.create'), $userRequest->toArray());

        $user = User::first();

        $response = $this->call('GET', route('user.get', ['id' => $user->id]));

        $response->assertStatus(200);
    }

    /**
     * Get all user
     * @test
     */
    public function get_all_user(): void
    {
        $userRequest = new UserRequest(
            [
                'fullname' => 'Luiz Augusto Neto',
                'document' => '09375156478',
                'email' => 'luiz@gmail.com',
                'password' => '123456',
                'user_type' => 'common',
            ]
        );

        $response = $this->call('POST', route('user.create'), $userRequest->toArray());

        $response = $this->call('GET', route('user.all'));

        $response->assertStatus(200);
    }

    /**
     * Do not create an existing user
     * @test
     */
    public function do_not_create_an_existing_user(): void
    {
        $userRequest = new UserRequest(
            [
                'fullname' => 'Luiz Augusto Neto',
                'document' => '09375156478',
                'email' => 'luiz@gmail.com',
                'password' => '123456',
                'user_type' => 'common',
            ]
        );

        $server = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        $response = $this->call('POST', route('user.create'), $userRequest->toArray(), [], [], $server);

        $response->assertStatus(201);

        $response2 = $this->call('POST', route('user.create'), $userRequest->toArray(), [], [], $server);

        $response2->assertStatus(302);
    }
}
