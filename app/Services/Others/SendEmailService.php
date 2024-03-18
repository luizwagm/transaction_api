<?php

namespace App\Services\Others;

use Illuminate\Support\Facades\Http;

class SendEmailService implements SendEmailServiceInterface
{
    /**
     * $url variable
     *
     * @var string
     */
    protected string $url;

    /**
     * Construct function
     */
    public function __construct()
    {
        $this->url = config('notification.url');
    }

    /**
     * Handle execute function
     *
     * @return object
     */
    public function handle(): object
    {
        $response = $this->getHttp();
        
        return $response->object();
    }

    /**
     * Get Http function
     *
     * @return object
     */
    public function getHttp(): object
    {
        return Http::get($this->url);
    }
}
