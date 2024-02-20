<?php

namespace App\Service;

class OzonService
{
    private int $clientId;
    private string $clientSecret;

    private string $baseUrl;

    public function __construct()
    {
        $this->clientId = \config('parser.client_id');
        $this->clientSecret = \config('parser.client_secret');
        $this->baseUrl = \config('parser.base_url');
    }

    public function getProductList()
    {
        $data = [
            "filter" => [
                "offer_id" => [
                    "136748"
                ],
                "product_id" => [
                    "223681945"
                ],
                "visibility" => "ALL"
            ],
            "last_id" => "",
            "limit" => 100
        ];

        $tokenKey = 'token';


        $headers = [
            'Client-Id: ' . $this->clientId,
            'Api-Key: ' . $this->clientSecret,
            'Content-Type: application/json'
        ];
        $curl = curl_init($this->baseUrl . '/v2/product/list');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $res = "cURL Error #:" . $err;
        } else {
            $res = json_decode($return, true);
        }
        return $res;

    }
}
