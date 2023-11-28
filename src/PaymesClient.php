<?php

namespace Paymes;

use Paymes\Service\OrdersService;

class PaymesClient
{
    protected static string $secretKey;
    public function PaymesClient(string $secretKey): void
    {
        self::$secretKey = $secretKey;
    }

}