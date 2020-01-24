<?php
    require '../vendor/autoload.php';
    require '../configuration/blob-storage-configuration.php';
    require '../helper/blob-storage-helper.php';
    require '../controller/ImageController.php';

    $imageController = new ImageController($blobClient);

    $response = [
        'message' => '',
        'imageName' => ''
    ];

    if(!isset($_FILES))
    {
        $response['message'] = 'Must upload a file';
    }
    else
    {
        $imageController->upload($_FILES['image'], $containerName);
        $response['message'] = 'Success';
        $response['imageName'] = $containerName;
    }

    echo json_encode($response);
