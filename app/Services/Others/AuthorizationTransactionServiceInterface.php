<?php

namespace App\Services\Others;

interface AuthorizationTransactionServiceInterface
{
    /**
     * Handle execute function
     *
     * @return object
     */
    public function handle(): object;

    /**
     * Get Http function
     *
     * @return object
     */
    public function getHttp(): object;
}
