<?php

namespace Tests\Unit;

use App\Services\Others\AuthorizationTransactionService;
use Tests\TestCase;

class AuthorizationTransactionServiceTest extends TestCase
{
    /**
     * authorization transaction service handle return object
     * @test
     */
    public function it_handles_authorization_transaction_return_object()
    {
        $handleMethod = $this->getMockBuilder(AuthorizationTransactionService::class)
            ->onlyMethods(['handle'])
            ->disableOriginalConstructor()
            ->getMock();

        $handleMethod->expects($this->never())
            ->method('handle')
            ->willReturn((object) ['message' => 'Autorizado']);
    }
}
