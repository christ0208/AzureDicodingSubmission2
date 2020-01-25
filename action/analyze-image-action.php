<?php
    require '../vendor/autoload.php';

    use GuzzleHttp\Client;

    $response = [];
    $subscriptionKey = 'dd22435bdac84c81ba0e726d16f757b1';
    $targetUrl = 'https://dicodingsubmission2vision.cognitiveservices.azure.com/vision/v2.0/analyze';
    $parameters = [
        'visualFeatures' => 'Categories,Description,Color',
        'details' => '',
        'language' => 'en'
    ];
    $requestMethod = 'POST';
    $headers = [
        'Content-Type' => 'application/octet-stream',
        'Ocp-Apim-Subscription-Key' => $subscriptionKey
    ];
    if(isset($_GET['name']))
    {
        $content = fopen('../public/images/' . $_GET['name'], 'r');
        $client = new Client();
        $respGuzzle = $client->request(
            $requestMethod,
            $targetUrl,
            [
                'query' => $parameters,
                'headers' => $headers,
                'body' => $content
            ]
        );
        $response = $respGuzzle->getBody();
        echo $response;
    }
    else
    {
        $response['message'] = 'Invalid Request';
        echo json_encode($response);
    }