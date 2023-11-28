<?php

namespace Paymes;

use Paymes\Service\OrdersService;

class PaymesClient
{
    protected static string $secretKey;
    /**
     * Client used to send requests to Paymes' API.
     *
     * @property OrdersService $orders
     */
    public function PaymesClient(string $secretKey): void
    {
        self::$secretKey = $secretKey;
    }

}