<?php

namespace Paymes\Service;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Paymes\PaymesClient;

class OrdersService extends PaymesClient
{
    public function create(
        string $orderId,
        string $price,
        string $currency,
        string $productName,
        string $buyerName,
        string $buyerPhone,
        string $buyerEmail,
        string $buyerAddress,
    )
    {
        $secretKey = parent::$secretKey;
        $inputString =
            $orderId .
            $price .
            $currency .
            $productName .
            $buyerName .
            $buyerPhone .
            $buyerEmail .
            $buyerAddress .
            $secretKey;

        // Calculating SHA512 hash
        $sha512Hash = hash('sha512', $inputString);

        // Base64 encoding from SHAA512 hash
        $base64Encoded = base64_encode($sha512Hash);

        $client = new Client();
        $response = $client->post('https://api.paym.es/v4.6/order_create',[
            RequestOptions::QUERY=>$base64Encoded
        ])->getBody()->getContents();
    }
}