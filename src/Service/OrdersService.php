<?php

namespace Paymes\Service;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Paymes\PaymesClient;

/**
 * Client used to send requests to Paymes' API.
 *
 * @property OrdersService $orders
 */
class OrdersService extends PaymesClient
{
    public function create($data)
    {
        $secretKey = parent::$secretKey;
        $inputString =
            $data['orderId'] .
            $data['price'] .
            $data['currency'] .
            $data['productName'] .
            $data['buyerName'] .
            $data['buyerPhone'] .
            $data['buyerEmail'] .
            $data['buyerAddress'] .
            $secretKey;

        // Calculating SHA512 hash
        $sha512Hash = hash('sha512', $inputString);

        // Base64 encoding from SHAA512 hash
        $base64Encoded = base64_encode($sha512Hash);

        $client = new Client();
        $response = $client->post('https://api.paym.es/v4.6/order_create',[
            RequestOptions::QUERY=>$base64Encoded
        ])->getBody()->getContents();
        var_dump($response);
    }
}