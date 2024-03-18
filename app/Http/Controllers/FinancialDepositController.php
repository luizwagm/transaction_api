<?php

namespace App\Http\Controllers;

use App\Events\DepositEvent;
use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Http\Resources\FinancialDeposit\DepositResource;
use App\Http\Resources\FinancialDeposit\GetDepositsResource;
use App\Services\FinancialDeposit\FinancialDepositServiceInterface;
use Illuminate\Http\JsonResponse;

class FinancialDepositController extends Controller
{
    /**
     * Constructs function
     *
     * @param FinancialDepositServiceInterface $service
     */
    public function __construct(
        protected FinancialDepositServiceInterface $service
    ) {}

    /**
    * @OA\Post(
     *     path="/api/deposit",
     *     summary="Create a new deposit",
     *     tags={"Deposit"},
     *     @OA\Parameter(
     *         name="wallet_id",
     *         in="query",
     *         description="Id of wallet to deposit",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="value",
     *         in="query",
     *         description="Value of deposit",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="Deposit registered successfully")
     * )
     */
    public function deposit(FinancialDepositRequest $request): JsonResponse
    {
        DepositEvent::dispatch($request);

        return response()->json(new DepositResource([]), 201);
    }

    /**
    * @OA\Get(
     *     path="/api/deposit/{walletId}",
     *     summary="Get all deposits of user",
     *     tags={"Deposit"},
     *     @OA\Parameter(
     *         name="walletId",
     *         in="path",
     *         description="Id of wallet",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Get all deposits of user")
     * )
     */
    public function get(int $walletId): GetDepositsResource
    {
        return new GetDepositsResource($this->service->get($walletId));
    }
}
