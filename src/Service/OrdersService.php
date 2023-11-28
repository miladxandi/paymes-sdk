<?php

namespace Paymes\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Mockery\Exception;
use Paymes\PaymesClient;


class OrdersService extends PaymesClient
{
    public function __construct(string $publicKey, string $secretKey)
    {
        parent::$publicKey = $publicKey;
        parent::$secretKey = $secretKey;
    }

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
        try {
            $client = new Client();
            $response = json_decode($client->post('https://api.paym.es/v4.6/order_create',[
                RequestOptions::FORM_PARAMS=>[
                    'publicKey' => self::$publicKey,
                    'hash' => $base64Encoded,
                    'orderId' => $data['price'],
                    'price' => $data['price'],
                    'currency' => $data['currency'],
                    'productName' => $data['productName'],
                    'buyerName' => $data['buyerName'],
                    'buyerPhone' => $data['buyerPhone'],
                    'buyerEmail' => $data['buyerEmail'],
                    'buyerAddress' => $data['buyerAddress'],
                    'create_order_by_kiosk' => false,
                ]
            ])->getBody()->getContents());
            return $response;
        }catch (ClientException $exception){
            return json_decode($exception->getResponse()->getBody()->getContents());
        }
    }
}
