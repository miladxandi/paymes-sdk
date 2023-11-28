<?php

namespace Paymes;

use Paymes\Service\OrdersService;

class PaymesClient extends BaseCLient
{
    protected static string $secretKey;
    /**
     * Client used to send requests to Paymes' API.
     *
     * @property OrdersService $orders
     */
    public function PaymesClient(string $secretKey)
    {
        self::$secretKey = $secretKey;
    }

}