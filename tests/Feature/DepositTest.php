<?php

namespace Tests\Feature;

use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepositTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Deposit to wallet
     * @test
     */
    public function deposit_to_wallet(): void
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

        $wallet = User::first()?->wallet;

        $financialDepositRequest = new FinancialDepositRequest(
            [
                'wallet_id' => $wallet->id,
                'value' => 100.50
            ]
        );

        $response = $this->call('POST', route('deposit.create'), $financialDepositRequest->toArray());

        $response->assertStatus(201);
    }

    /**
     * Get deposit to wallet
     * @test
     */
    public function get_deposit_to_wallet(): void
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

        $wallet = User::first()?->wallet;

        $response = $this->call('GET', route('deposit.get', ['walletId' => $wallet->id]));

        $response->assertStatus(200);
    }
}
