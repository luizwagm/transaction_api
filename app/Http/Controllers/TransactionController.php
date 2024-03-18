<?php

namespace App\Http\Controllers;

use App\Events\CreateTransactionEvent;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Resources\Transaction\GetTransactionResource;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;
use App\Services\Transaction\TransactionServiceInterface;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    /**
     * Construct function
     *
     * @param TransactionServiceInterface $service
     */
    public function __construct(
        protected TransactionServiceInterface $service
    ) {}

    /**
    * @OA\Post(
     *     path="/api/transaction",
     *     summary="Create a new transaction",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *         name="wallet_id",
     *         in="query",
     *         description="Id of wallet to payer",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="destination_wallet_id",
     *         in="query",
     *         description="Id of wallet to payee",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description (optional)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="value",
     *         in="query",
     *         description="Value of transaction",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="Transaction registered successfully")
     * )
     */
    public function transaction(TransactionRequest $request): JsonResponse
    {
        CreateTransactionEvent::dispatch($request);

        return response()->json(new TransactionResource([]), 201);
    }

    /**
    * @OA\Get(
     *     path="/api/transaction/{walletId}/{user}",
     *     summary="Get all transactions of user",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *         name="walletId",
     *         in="path",
     *         description="Id of wallet",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User type",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={
     *                   "payer",
     *                   "payee",
     *             },
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get all transactions of user")
     * )
     */
    public function get(int $walletId, string $user = Transaction::PAYER): GetTransactionResource
    {
        return new GetTransactionResource($this->service->get($walletId, $user));
    }
}
