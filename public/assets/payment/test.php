<?php
require_once './vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

try {

    $convertedPrice = (int)($lockerAccountResult[0]['price'] * 100);
    // Send the request to Paymongo API to generate a link
    $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
        'body' => json_encode([
            'data' => [
                'attributes' => [
                    'amount' => $convertedPrice,
                    'redirect' => [
                        'success' => 'http://localhost/smart/views/kiosk/?view=PAYMENTCONFIRMATION&code=' . $code . '&message=success',
                        'failed' => 'http://localhost/smart/views/kiosk/?view=PAYMENTCONFIRMATION&code=' . $code . '&message=failed'
                    ],
                    'type' => 'gcash',
                    'currency' => 'PHP',
                ]
            ]
        ]),
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Basic c2tfdGVzdF9GZUJIRmdDN2hmUzh4VGg2eFJXZ0JXNmo6',
            'content-type' => 'application/json',
        ],
    ]);

    // Decode the JSON response to extract the checkout URL
    $responseData = json_decode($response->getBody(), true);
    $account_id = $lockerAccountResult[0]['account_id'];
    $code = $lockerAccountResult[0]['code'];
    $checkoutUrl = $responseData['data']['attributes']['redirect']['checkout_url'];
    $sourceId = $responseData['data']['id'];
  
    $pay = $portCont->accountPaymentDetails($account_id, $code, $checkoutUrl, $sourceId);
    if(!empty($pay))
    {
        $checkoutUrl = 'https://test-sources.paymongo.com/sources?id=' . $pay[0]['src_link'];
    }
    else
    {
        $checkoutUrl = $responseData['data']['attributes']['redirect']['checkout_url'];
    }
 

} catch (\GuzzleHttp\Exception\RequestException $e) {
    // Handle request errors
    echo 'Request failed: ' . $e->getMessage();
}
?>

