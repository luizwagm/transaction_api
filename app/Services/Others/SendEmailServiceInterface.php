<?php

namespace App\Services\Others;

interface SendEmailServiceInterface
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
