<?php

namespace App\Utilities;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Termwind\Components\Dd;

//use Psr\Http\Message\ResponseInterface;
//use GuzzleHttp\Exception\RequestException;
//use GuzzleHttp\Psr7\Utils;

class PaymentHelper
{
    private const BASE_API_URL = 'https://sandbox.ipaymu.com/api/v2';
    private const NOTIFY_URL = 'https://127.0.0.1:8000/notify';

    private static function getAPIKey()
    {
        return config('payment.api_key');
    }
    private static function getVA()
    {
        return config('payment.va');
    }

    private static function generateSignature($body = [], $method = 'POST')
    {
        $va = self::getVA();
        $secret = self::getAPIKey();
        $method = strtoupper($method);

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody = strtolower(hash('sha256', $jsonBody));
        $stringToSign = "$method:$va:$requestBody:$secret";
        return hash_hmac('sha256', $stringToSign, $secret);
    }

    private static function getDate()
    {
        return Date('YmdHis');
    }

    public static function getPaymentList()
    {
        $url = self::BASE_API_URL . '/payment-method-list';
        $body = [
            'referenceId' => '1234567890',
        ];

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'va' => self::getVA(),
            'signature' => self::generateSignature($body),
            'timestamp' => self::getDate(),
        ];
        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => $body
        ]);

        try {
            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Isi body:
     * - product (array)
     * - qty (array)
     * - price (array)
     * - description (array) | optional
     * - returnUrl (string)
     * - notifyUrl (string)
     * - cancelUrl (string)
     * - referenceId (string)
     * - buyerName (string)
     * - buyerEmail (string)
     * - buyerPhone (string)
     * - paymentMethod (string) | optional
     * @param array $body
     * @return mixed
     */
    public static function redirectPayment($body)
    {
        $url = self::BASE_API_URL . '/payment';
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'va' => self::getVA(),
            'signature' => self::generateSignature($body),
            'timestamp' => self::getDate(),
        ];
        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => $body
        ]);

        try {
            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }
}
