<?php

namespace App\Exceptions;

use Exception;

class WalletNotAmountException extends Exception
{
    public function render()
    {       
        return response()->json(
            [
                "error" => true,
                "message" => "Financial transaction with no value in the wallet"
            ]
        );
    }
}
