<?php

namespace App\Services;

class HelperServices
{

    public function getOrderAndCustomerDetails($orderId)
    {
        $shopifyAccessToken = env('SHOPIFY_ACCESS_TOKEN');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fashionstore-2024.myshopify.com/admin/api/2023-10/orders.json?id='.$orderId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-Shopify-Access-Token: '.$shopifyAccessToken,
                'Cookie: _shopify_y=aa95ed7d-59b4-44ae-9796-d55bc072d397; _tracking_consent=%7B%22con%22%3A%7B%22CMP%22%3A%7B%22m%22%3A%22%22%2C%22a%22%3A%22%22%2C%22p%22%3A%22%22%2C%22s%22%3A%22%22%7D%7D%2C%22region%22%3A%22USNY%22%2C%22reg%22%3A%22%22%2C%22v%22%3A%222.1%22%7D'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
