<?php

namespace Tests\Feature;

use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create transaction between 2 users successfully
     * @test
     */
    public function create_transaction_between_two_users_successfully(): void
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

        $user1 = $this->call('POST', route('user.create'), $userRequest->toArray());
        $user1 = User::where('document', $user1->getData()?->document)->first();

        $financialDepositRequest = new FinancialDepositRequest(
            [
                'wallet_id' => $user1->wallet?->id,
                'value' => 100.00
            ]
        );

        $depositUser1 = $this->call('POST', route('deposit.create'), $financialDepositRequest->toArray());

        $userRequest2 = new UserRequest(
            [
                'fullname' => 'Felipe Augusto Silva',
                'document' => '09375156477',
                'email' => 'luiz2@gmail.com',
                'password' => '123456',
                'user_type' => 'shopman',
            ]
        );

        $user2 = $this->call('POST', route('user.create'), $userRequest2->toArray());
        $user2 = User::where('document', $user2->getData()?->document)->first();

        $transactionRequest = new TransactionRequest(
            [
                'wallet_id' => $user1?->wallet?->id,
                'destination_wallet_id' => $user2?->wallet?->id,
                'description' => 'anything',
                'value' => 30.00,
            ]
        );

        $response = $this->call('POST', route('transaction.create'), $transactionRequest->toArray());

        $response->assertStatus(201);
    }

    /**
     * Get transactions to wallet
     * @test
     */
    public function get_transactions_to_wallet(): void
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

        $user1 = $this->call('POST', route('user.create'), $userRequest->toArray());
        $user1 = User::where('document', $user1->getData()?->document)->first();

        $financialDepositRequest = new FinancialDepositRequest(
            [
                'wallet_id' => $user1->wallet?->id,
                'value' => 100.00
            ]
        );

        $depositUser1 = $this->call('POST', route('deposit.create'), $financialDepositRequest->toArray());

        $userRequest2 = new UserRequest(
            [
                'fullname' => 'Felipe Augusto Silva',
                'document' => '09375156477',
                'email' => 'luiz2@gmail.com',
                'password' => '123456',
                'user_type' => 'shopman',
            ]
        );

        $user2 = $this->call('POST', route('user.create'), $userRequest2->toArray());
        $user2 = User::where('document', $user2->getData()?->document)->first();

        $transactionRequest = new TransactionRequest(
            [
                'wallet_id' => $user1?->wallet?->id,
                'destination_wallet_id' => $user2?->wallet?->id,
                'description' => 'anything',
                'value' => 30.00,
            ]
        );

        $transaction = $this->call('POST', route('transaction.create'), $transactionRequest->toArray());

        $response = $this->call(
            'GET',
            route(
                'transaction.get',
                [
                    'walletId' => $user1?->wallet?->id,
                    'user' => Transaction::PAYER
                ]
            )
        );

        $response->assertStatus(200);
    }

    /**
     * Not Create transaction between 2 users. User shopman can't transaction
     * @test
     */
    public function not_create_transaction_between_two_users_shopman(): void
    {
        $userRequest = new UserRequest(
            [
                'fullname' => 'Luiz Augusto Neto',
                'document' => '09375156478',
                'email' => 'luiz@gmail.com',
                'password' => '123456',
                'user_type' => 'shopman',
            ]
        );

        $user1 = $this->call('POST', route('user.create'), $userRequest->toArray());
        $user1 = User::where('document', $user1->getData()?->document)->first();

        $financialDepositRequest = new FinancialDepositRequest(
            [
                'wallet_id' => $user1->wallet?->id,
                'value' => 100.00
            ]
        );

        $depositUser1 = $this->call('POST', route('deposit.create'), $financialDepositRequest->toArray());

        $userRequest2 = new UserRequest(
            [
                'fullname' => 'Felipe Augusto Silva',
                'document' => '09375156477',
                'email' => 'luiz2@gmail.com',
                'password' => '123456',
                'user_type' => 'common',
            ]
        );

        $user2 = $this->call('POST', route('user.create'), $userRequest2->toArray());
        $user2 = User::where('document', $user2->getData()?->document)->first();

        $transactionRequest = new TransactionRequest(
            [
                'wallet_id' => $user1?->wallet?->id,
                'destination_wallet_id' => $user2?->wallet?->id,
                'description' => 'anything',
                'value' => 30.00,
            ]
        );

        $response = $this->call('POST', route('transaction.create'), $transactionRequest->toArray());

        $response->assertStatus(422);
    }

    /**
     * Not Create transaction between 2 users. Empty wallet
     * @test
     */
    public function not_create_transaction_between_two_users_empty_wallet(): void
    {
        $userRequest = new UserRequest(
            [
                'fullname' => 'Luiz Augusto Neto',
                'document' => '09375156478',
                'email' => 'luiz@gmail.com',
                'password' => '123456',
                'user_type' => 'shopman',
            ]
        );

        $user1 = $this->call('POST', route('user.create'), $userRequest->toArray());
        $user1 = User::where('document', $user1->getData()?->document)->first();

        $userRequest2 = new UserRequest(
            [
                'fullname' => 'Felipe Augusto Silva',
                'document' => '09375156477',
                'email' => 'luiz2@gmail.com',
                'password' => '123456',
                'user_type' => 'common',
            ]
        );

        $user2 = $this->call('POST', route('user.create'), $userRequest2->toArray());
        $user2 = User::where('document', $user2->getData()?->document)->first();

        $transactionRequest = new TransactionRequest(
            [
                'wallet_id' => $user1?->wallet?->id,
                'destination_wallet_id' => $user2?->wallet?->id,
                'description' => 'anything',
                'value' => 30.00,
            ]
        );

        $response = $this->call('POST', route('transaction.create'), $transactionRequest->toArray());

        $response->assertStatus(422);
    }
}
